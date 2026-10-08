<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Maintenance;
use App\Models\SparePart;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEquipment = Equipment::count();
        $totalMaintenance = Maintenance::count();
        $totalSpareParts = SparePart::count();
        $totalUsers = User::count();
        $scheduledMaintenance = Maintenance::where('status', 'scheduled')->count();
        $inProgressMaintenance = Maintenance::where('status', 'in_progress')->count();
        $completedMaintenance = Maintenance::where('status', 'completed')->count();
        $lowStockParts = SparePart::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->orderBy('stock')->get();
        $recentMaintenances = Maintenance::with([
            'equipment',
            'technician',
        ])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalEquipment',
            'totalMaintenance',
            'totalSpareParts',
            'totalUsers',
            'scheduledMaintenance',
            'inProgressMaintenance',
            'completedMaintenance',
            'lowStockParts',
            'recentMaintenances'
        ));
    }
}
