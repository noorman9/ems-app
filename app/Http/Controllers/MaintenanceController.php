<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Equipment;
use App\Models\User;
use App\Models\SparePart;
use Illuminate\Support\Facades\DB;


class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::with(['equipment', 'technician'])
            ->latest()
            ->get();

        return view('maintenance.index', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipment = Equipment::where('status', '!=', 'inactive')
            ->get();

        $technicians = User::where('role', 'technician')
            ->get();

        return view('maintenance.create', compact(
            'equipment',
            'technicians'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => ['required', 'exists:equipment,id'],
            'technician_id' => ['required', 'exists:users,id'],
            'type' => ['required', 'in:preventive,corrective'],
            'scheduled_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'cost' => ['nullable', 'numeric', 'min:0'],
        ]);

        Maintenance::create($validated);

        return redirect()
            ->route('maintenance.index')
            ->with('success', 'Maintenance berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        $maintenance->load([
            'equipment',
            'technician',
            'spareParts',
        ]);

        $spareParts = SparePart::orderBy('name')->get();

        return view('maintenance.show', compact(
            'maintenance',
            'spareParts'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        $equipment = Equipment::where('status', '!=', 'inactive')
            ->get();

        $technicians = User::where('role', 'technician')
            ->get();

        return view('maintenance.edit', compact(
            'maintenance',
            'equipment',
            'technicians'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'equipment_id' => ['required', 'exists:equipment,id'],
            'technician_id' => ['required', 'exists:users,id'],
            'type' => ['required', 'in:preventive,corrective'],
            'scheduled_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'cost' => ['nullable', 'numeric', 'min:0'],
        ]);

        $maintenance->update($validated);

        return redirect()
            ->route('maintenance.index')
            ->with('success', 'Maintenance berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()
            ->route('maintenance.index')
            ->with('success', 'Maintenance berhasil dihapus.');
    }

    public function start(Maintenance $maintenance)
    {
        if ($maintenance->status !== 'scheduled') {
            return back()->withErrors([
                'status' => 'Maintenance tidak dapat dimulai.',
            ]);
        }

        $maintenance->update([
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        return back()->with('success', 'Maintenance dimulai.');
    }

    public function complete(Maintenance $maintenance)
    {
        if ($maintenance->status !== 'in_progress') {
            return back()->withErrors([
                'status' => 'Maintenance belum dalam proses.',
            ]);
        }

        $maintenance->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Maintenance berhasil diselesaikan.');
    }

    public function addSparePart(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'spare_part_id' => ['required', 'exists:spare_parts,id'],
            'quantity' => ['required', 'numeric', 'gt:0'],
        ]);

        DB::transaction(function () use ($validated, $maintenance, $request) {
            $sparePart = SparePart::whereKey($validated['spare_part_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($sparePart->stock < $validated['quantity']) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'quantity' => 'Stock tidak mencukupi.',
                ]);
            }

            $existing = $maintenance->spareParts()
                ->where('spare_part_id', $sparePart->id)
                ->first();

            if ($existing) {
                $newQuantity =
                    $existing->pivot->quantity + $validated['quantity'];

                $maintenance->spareParts()->updateExistingPivot(
                    $sparePart->id,
                    [
                        'quantity' => $newQuantity,
                    ]
                );
            } else {
                $maintenance->spareParts()->attach(
                    $sparePart->id,
                    [
                        'quantity' => $validated['quantity'],
                    ]
                );
            }

            $sparePart->decrement(
                'stock',
                $validated['quantity']
            );

            $sparePart->stockMovements()->create([
                'user_id' => $request->user()->id,
                'type' => 'out',
                'quantity' => $validated['quantity'],
                'note' => 'Digunakan untuk maintenance #' . $maintenance->id,
            ]);
        });

        return back()->with(
            'success',
            'Spare part berhasil ditambahkan dan stock diperbarui.'
        );
    }
}
