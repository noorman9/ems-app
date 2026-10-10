<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockMovementController extends Controller
{

    public function index()
    {
        $movements = StockMovement::with(['sparePart', 'user'])
            ->latest()
            ->get();

        return view('stock_movements.index', compact('movements'));
    }
    public function create()
    {
        $spareParts = SparePart::orderBy('name')->get();

        return view('stock_movements.create', compact('spareParts'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'spare_part_id' => ['required', 'exists:spare_parts,id'],
            'type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'numeric', 'gt:0', 'decimal:0,2'],
            'note' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($request, $validated) {
            $sparePart = SparePart::whereKey($validated['spare_part_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $quantity = $validated['quantity'];

            if (
                $validated['type'] === 'out' &&
                bccomp((string) $sparePart->stock, (string) $quantity, 2) < 0
            ) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stock tidak mencukupi.',
                ]);
            }

            if ($validated['type'] === 'in') {
                $sparePart->increment('stock', $quantity);
            } else {
                $sparePart->decrement('stock', $quantity);
            }

            StockMovement::create([
                'spare_part_id' => $sparePart->id,
                'user_id' => $request->user()->id,
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'note' => $validated['note'] ?? null,
            ]);
        });

        return redirect()
            ->route('spare-parts.index')
            ->with('success', 'Stock berhasil diperbarui.');
    }
}
