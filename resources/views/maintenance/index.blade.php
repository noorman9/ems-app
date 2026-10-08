@extends('layouts.app')

@section('title', 'Maintenance')

@section('content')



@if (session('success'))
<p>{{ session('success') }}</p>
@endif

<div class="page-header">

    <div>
        <h1>Maintenance</h1>

        <p class="page-description">
            Daftar aktivitas maintenance equipment.
        </p>
    </div>

    <a href="{{ route('maintenance.create') }}"
        class="btn btn-primary">
        + Tambah Maintenance
    </a>

</div>


@if ($maintenances->isEmpty())

<p>Belum ada maintenance.</p>

@else

<table>

    <thead>
        <tr>
            <th>Equipment</th>
            <th>Technician</th>
            <th>Type</th>
            <th>Scheduled Date</th>
            <th>Status</th>
            <th>Cost</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($maintenances as $maintenance)
        <tr>
            <td>{{ $maintenance->equipment->name }}</td>
            <td>{{ $maintenance->technician->name }}</td>
            <td>{{ ucfirst($maintenance->type) }}</td>
            <td>{{ $maintenance->scheduled_date->format('Y-m-d') }}</td>
            <td>
                <span class="badge badge-{{ str_replace('_', '-', $maintenance->status) }}">
                    {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                </span>
            </td>
            <td>
                Rp {{ number_format($maintenance->cost, 0, ',', '.') }}
            </td>
            <td>
                <a href="{{ route('maintenance.show', $maintenance) }}"
                    class="btn btn-secondary">
                    Detail
                </a>

                <a href="{{ route('maintenance.edit', $maintenance) }}"
                    class="btn btn-secondary">
                    Edit
                </a>

                <form
                    action="{{ route('maintenance.destroy', $maintenance) }}"
                    method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

@endif
@endsection