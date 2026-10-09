@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1>Laporan Maintenance</h1>
        <p>Riwayat dan ringkasan biaya pemeliharaan equipment.</p>
    </div>
</div>

{{-- Filter laporan --}}
<div class="card">
    <h2>Filter Laporan</h2>

    <form action="{{ route('reports.index') }}" method="GET"
        class="form-grid">

        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input
                type="date"
                id="start_date"
                name="start_date"
                value="{{ request('start_date') }}">
        </div>

        <div class="form-group">
            <label for="end_date">Tanggal Akhir</label>
            <input
                type="date"
                id="end_date"
                name="end_date"
                value="{{ request('end_date') }}">
        </div>

        <div class="form-group">
            <label for="status">Status Maintenance</label>
            <select id="status" name="status">
                <option value="">Semua Status</option>
                <option value="scheduled"
                    @selected(request('status')==='scheduled' )>
                    Scheduled
                </option>
                <option value="in_progress"
                    @selected(request('status')==='in_progress' )>
                    In Progress
                </option>
                <option value="completed"
                    @selected(request('status')==='completed' )>
                    Completed
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>&nbsp;</label>
            <div>
                <button type="submit">Terapkan Filter</button>
                <a href="{{ route('reports.index') }}">Reset</a>
            </div>
        </div>
    </form>
</div>

{{-- Ringkasan --}}
<div class="dashboard-grid">
    <div class="card">
        <p>Total Maintenance</p>
        <h2>{{ $totalMaintenance }}</h2>
    </div>

    <div class="card">
        <p>Maintenance Selesai</p>
        <h2>{{ $completedMaintenance }}</h2>
    </div>

    <div class="card">
        <p>Total Biaya Maintenance</p>
        <h2>Rp {{ number_format($totalCost, 0, ',', '.') }}</h2>
    </div>
</div>

{{-- Tabel laporan --}}
<div class="card">
    <h2>Riwayat Maintenance</h2>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Tanggal Jadwal</th>
                    <th>Equipment</th>
                    <th>Teknisi</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Biaya</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($maintenances as $maintenance)
                <tr>
                    <td>
                        {{ $maintenance->scheduled_date?->format('d/m/Y') ?? '-' }}
                    </td>

                    <td>
                        {{ $maintenance->equipment?->name ?? '-' }}
                    </td>

                    <td>
                        {{ $maintenance->technician?->name ?? '-' }}
                    </td>

                    <td>
                        {{ ucfirst($maintenance->type) }}
                    </td>

                    <td>
                        {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                    </td>

                    <td>
                        Rp {{ number_format((float) $maintenance->cost, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        Tidak ada data maintenance untuk filter ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection