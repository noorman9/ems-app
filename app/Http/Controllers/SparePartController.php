<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spareParts = SparePart::latest()->get();

        return view('spare_parts.index', compact('spareParts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spare_parts.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:spare_parts,code'],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'unit' => ['required', 'string', 'max:50'],
            'minimum_stock' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'description' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $sparePart = SparePart::create($validated);

            $initialStock = $validated['stock'];

            // Catat stok awal hanya jika jumlahnya lebih dari nol.
            if (bccomp((string) $initialStock, '0', 2) > 0) { {
                    StockMovement::create([
                        'spare_part_id' => $sparePart->id,
                        'user_id' => $request->user()->id,
                        'type' => 'in',
                        'quantity' => $initialStock,
                        'note' => 'Stok awal saat registrasi',
                    ]);
                }
            }
        });

        return redirect()
            ->route('spare-parts.index')
            ->with('success', 'Spare part berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(SparePart $sparePart)
    {
        return view('spare_parts.show', compact('sparePart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePart $sparePart)
    {
        return view('spare_parts.edit', compact('sparePart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SparePart $sparePart)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:255',
                'unique:spare_parts,code,' . $sparePart->id,
            ],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:50'],
            'minimum_stock' => [
                'required',
                'numeric',
                'min:0',
                'decimal:0,2',
            ],
            'description' => ['nullable', 'string'],
        ]);

        $sparePart->update($validated);

        return redirect()
            ->route('spare-parts.show', $sparePart)
            ->with('success', 'Spare part berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(SparePart $sparePart)
    {
        if ($sparePart->stockMovements()->exists()) {
            return back()->withErrors([
                'delete' => 'Spare part tidak dapat dihapus karena memiliki riwayat pergerakan stok.',
            ]);
        }

        if ($sparePart->maintenances()->exists()) {
            return back()->withErrors([
                'delete' => 'Spare part tidak dapat dihapus karena tercatat dalam maintenance.',
            ]);
        }

        $sparePart->delete();

        return redirect()
            ->route('spare-parts.index')
            ->with('success', 'Spare part berhasil dihapus.');
    }
}
