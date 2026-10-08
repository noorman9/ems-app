@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="header">
    <h1>Dashboard</h1>
    <p>Equipment Maintenance System</p>
</div>

<div class="summary">

    <div class="card">
        <div class="card-title">Equipment</div>
        <div class="card-value">
            {{ $totalEquipment }}
        </div>
    </div>

    <div class="card">
        <div class="card-title">Maintenance</div>
        <div class="card-value">
            {{ $totalMaintenance }}
        </div>
    </div>

    <div class="card">
        <div class="card-title">Spare Parts</div>
        <div class="card-value">
            {{ $totalSpareParts }}
        </div>
    </div>

    <div class="card">
        <div class="card-title">Users</div>
        <div class="card-value">
            {{ $totalUsers }}
        </div>
    </div>

</div>

<div class="section-grid">

    <div class="card section">

        <h2>Maintenance Status</h2>

        <div class="status-item">
            <span>Scheduled</span>
            <strong>{{ $scheduledMaintenance }}</strong>
        </div>

        <div class="status-item">
            <span>In Progress</span>
            <strong>{{ $inProgressMaintenance }}</strong>
        </div>

        <div class="status-item">
            <span>Completed</span>
            <strong>{{ $completedMaintenance }}</strong>
        </div>

    </div>

    <div class="card section low-stock">

        <h2>Low Stock Spare Parts</h2>

        @forelse ($lowStockParts as $sparePart)

            <div class="low-stock-item">

                <strong>
                    {{ $sparePart->code }}
                    -
                    {{ $sparePart->name }}
                </strong>

                <div class="warning">
                    Stock:
                    {{ $sparePart->stock }}
                    {{ $sparePart->unit }}
                </div>

                <small>
                    Minimum:
                    {{ $sparePart->minimum_stock }}
                    {{ $sparePart->unit }}
                </small>

            </div>

        @empty

            <p class="empty">
                Semua spare part memiliki stock yang aman.
            </p>

        @endforelse

    </div>

</div>

<div class="card section">

    <h2>Recent Maintenance</h2>

    <table>

        <thead>
            <tr>
                <th>Equipment</th>
                <th>Technician</th>
                <th>Type</th>
                <th>Status</th>
                <th>Scheduled Date</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($recentMaintenances as $maintenance)

                <tr>

                    <td>
                        {{ $maintenance->equipment->code }}
                        -
                        {{ $maintenance->equipment->name }}
                    </td>

                    <td>
                        {{ $maintenance->technician->name }}
                    </td>

                    <td>
                        {{ ucfirst($maintenance->type) }}
                    </td>

                    <td>
                        {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                    </td>

                    <td>
                        {{ $maintenance->scheduled_date->format('d-m-Y') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5">
                        Belum ada maintenance.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection