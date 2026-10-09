<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Maintenance::with(['equipment', 'technician']);

        // Filter tanggal mulai
        if ($request->filled('start_date')) {
            $query->whereDate(
                'scheduled_date',
                '>=',
                $request->start_date
            );
        }

        // Filter tanggal akhir
        if ($request->filled('end_date')) {
            $query->whereDate(
                'scheduled_date',
                '<=',
                $request->end_date
            );
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $maintenances = $query
            ->orderByDesc('scheduled_date')
            ->get();

        $totalMaintenance = $maintenances->count();

        $totalCost = $maintenances->sum(
            fn($maintenance) => (float) $maintenance->cost
        );

        $completedMaintenance = $maintenances
            ->where('status', 'completed')
            ->count();

        return view('reports.index', compact(
            'maintenances',
            'totalMaintenance',
            'totalCost',
            'completedMaintenance'
        ));
    }
}
