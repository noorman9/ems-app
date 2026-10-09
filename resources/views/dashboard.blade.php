@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-header">
    <div>
        <h1>Dashboard</h1>
        <p class="page-description">
            Overview kondisi equipment dan aktivitas maintenance.
        </p>
    </div>

    <div class="dashboard-date">
        <span>Today</span>
        <strong>{{ now()->format('d M Y') }}</strong>
    </div>
</div>

<div class="summary">

    <div class="card summary-card">
        <div class="summary-icon icon-equipment">EQ</div>
        <div>
            <div class="card-title">Total Equipment</div>
            <div class="card-value">{{ $totalEquipment }}</div>
            <div class="summary-caption">Equipment terdaftar</div>
        </div>
    </div>

    <div class="card summary-card">
        <div class="summary-icon icon-maintenance">MT</div>
        <div>
            <div class="card-title">Total Maintenance</div>
            <div class="card-value">{{ $totalMaintenance }}</div>
            <div class="summary-caption">Seluruh aktivitas</div>
        </div>
    </div>

    <div class="card summary-card">
        <div class="summary-icon icon-spare-parts">SP</div>
        <div>
            <div class="card-title">Spare Parts</div>
            <div class="card-value">{{ $totalSpareParts }}</div>
            <div class="summary-caption">Jenis spare part</div>
        </div>
    </div>

    <div class="card summary-card">
        <div class="summary-icon icon-users">US</div>
        <div>
            <div class="card-title">Total Users</div>
            <div class="card-value">{{ $totalUsers }}</div>
            <div class="summary-caption">Pengguna terdaftar</div>
        </div>
    </div>

</div>

<div class="section-grid">

    <div class="card section">
        <div class="section-heading">
            <div>
                <h2>Maintenance Status</h2>
                <p class="section-description">
                    Ringkasan status aktivitas maintenance.
                </p>
            </div>
        </div>

        <div class="status-item">
            <span>
                <span class="status-dot dot-scheduled"></span>
                Scheduled
            </span>
            <strong>{{ $scheduledMaintenance }}</strong>
        </div>

        <div class="status-item">
            <span>
                <span class="status-dot dot-progress"></span>
                In Progress
            </span>
            <strong>{{ $inProgressMaintenance }}</strong>
        </div>

        <div class="status-item">
            <span>
                <span class="status-dot dot-completed"></span>
                Completed
            </span>
            <strong>{{ $completedMaintenance }}</strong>
        </div>
    </div>

    <div class="card section low-stock">
        <div class="section-heading">
            <div>
                <h2>Low Stock Alerts</h2>
                <p class="section-description">
                    Spare part yang perlu diperhatikan.
                </p>
            </div>
            <span class="alert-label">Stock Alert</span>
        </div>

        @forelse ($lowStockParts as $sparePart)

        @php
        $stockPercentage = $sparePart->minimum_stock > 0
        ? min(100, ($sparePart->stock / $sparePart->minimum_stock) * 100)
        : 0;
        @endphp

        <div class="low-stock-item">
            <div class="low-stock-name">
                <strong>
                    {{ $sparePart->code }} - {{ $sparePart->name }}
                </strong>
                <span class="warning">
                    {{ $sparePart->stock }} {{ $sparePart->unit }}
                </span>
            </div>

            <div class="stock-progress">
                <div
                    class="stock-progress-bar"
                    style="--stock-percentage: {{ $stockPercentage }}%">
                </div>
            </div>

            <small>
                Minimum stock:
                {{ $sparePart->minimum_stock }} {{ $sparePart->unit }}
            </small>
        </div>

        @empty

        <p class="empty">
            Semua spare part berada di atas batas minimum stock.
        </p>

        @endforelse
    </div>

</div>

<div class="card section recent-maintenance">

    <div class="section-heading">
        <div>
            <h2>Recent Maintenance</h2>
            <p class="section-description">
                Aktivitas maintenance yang terakhir tercatat.
            </p>
        </div>

        <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">
            Lihat Semua
        </a>
    </div>

    <div class="table-wrapper">
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
                        <strong>{{ $maintenance->equipment->code }}</strong>
                        <div class="table-secondary">
                            {{ $maintenance->equipment->name }}
                        </div>
                    </td>

                    <td>{{ $maintenance->technician->name }}</td>

                    <td>{{ ucfirst($maintenance->type) }}</td>

                    <td>
                        <span class="badge badge-{{ str_replace('_', '-', $maintenance->status) }}">
                            {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                        </span>
                    </td>

                    <td>
                        {{ $maintenance->scheduled_date->format('d-m-Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty table-empty">
                        Belum ada aktivitas maintenance.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection