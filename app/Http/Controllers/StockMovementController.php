<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use App\Models\StockMovement;
use Illuminate\Http\Request;

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
            'quantity' => ['required', 'numeric', 'gt:0'],
            'note' => ['nullable', 'string'],
        ]);

        $sparePart = SparePart::findOrFail($validated['spare_part_id']);

        if (
            $validated['type'] === 'out' &&
            $sparePart->stock < $validated['quantity']
        ) {
            return back()
                ->withErrors([
                    'quantity' => 'Stock tidak mencukupi.',
                ])
                ->withInput();
        }

        StockMovement::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        if ($validated['type'] === 'in') {
            $sparePart->increment('stock', $validated['quantity']);
        } else {
            $sparePart->decrement('stock', $validated['quantity']);
        }

        return redirect()
            ->route('spare-parts.index')
            ->with('success', 'Stock berhasil diperbarui.');
    }
}
