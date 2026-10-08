@extends('layouts.app')

@section('title', 'Detail Maintenance')

@section('content')

<div class="page-header">

    <div>
        <h1>Maintenance Detail</h1>

        <p class="page-description">
            Detail aktivitas dan penggunaan spare part.
        </p>
    </div>

    <a href="{{ route('maintenance.index') }}"
        class="btn btn-secondary">
        ← Kembali
    </a>

</div>


{{-- Informasi Maintenance --}}

<div class="card section">

    <h2>Informasi Maintenance</h2>

    <table>

        <tr>
            <th>Equipment</th>
            <td>
                {{ $maintenance->equipment->code }}
                -
                {{ $maintenance->equipment->name }}
            </td>
        </tr>

        <tr>
            <th>Technician</th>
            <td>
                {{ $maintenance->technician->name }}
            </td>
        </tr>

        <tr>
            <th>Type</th>
            <td>
                {{ ucfirst($maintenance->type) }}
            </td>
        </tr>

        <tr>
            <th>Scheduled Date</th>
            <td>
                {{ $maintenance->scheduled_date->format('d-m-Y') }}
            </td>
        </tr>

        <tr>
            <th>Status</th>
            <td>
                <span class="badge badge-{{ str_replace('_', '-', $maintenance->status) }}">
                    {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                </span>
            </td>
        </tr>

        <tr>
            <th>Cost</th>
            <td>
                Rp {{ number_format($maintenance->cost, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th>Description</th>
            <td>
                {{ $maintenance->description ?? '-' }}
            </td>
        </tr>

    </table>

</div>


{{-- Workflow --}}

<div class="card section">

    <h2>Maintenance Workflow</h2>

    @if ($maintenance->status === 'scheduled')

    <p>
        Maintenance belum dimulai.
    </p>

    <form
        action="{{ route('maintenance.start', $maintenance) }}"
        method="POST">

        @csrf
        @method('PATCH')

        <button type="submit" class="btn btn-success">
            Start Maintenance
        </button>

    </form>

    @elseif ($maintenance->status === 'in_progress')

    <p>
        Maintenance sedang dikerjakan.
    </p>

    @if ($maintenance->started_at)
    <p>
        <strong>Started:</strong>
        {{ $maintenance->started_at->format('d-m-Y H:i') }}
    </p>
    @endif

    <form
        action="{{ route('maintenance.complete', $maintenance) }}"
        method="POST">

        @csrf
        @method('PATCH')

        <button type="submit" class="btn btn-success">
            Complete Maintenance
        </button>

    </form>

    @elseif ($maintenance->status === 'completed')

    <p>
        Maintenance telah selesai.
    </p>

    @if ($maintenance->started_at)
    <p>
        <strong>Started:</strong>
        {{ $maintenance->started_at->format('d-m-Y H:i') }}
    </p>
    @endif

    @if ($maintenance->completed_at)
    <p>
        <strong>Completed:</strong>
        {{ $maintenance->completed_at->format('d-m-Y H:i') }}
    </p>
    @endif

    @endif

</div>


{{-- Spare Parts Used --}}

<div class="card section">

    <h2>Spare Parts Used</h2>

    <table>

        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($maintenance->spareParts as $sparePart)

            <tr>

                <td>
                    {{ $sparePart->code }}
                </td>

                <td>
                    {{ $sparePart->name }}
                </td>

                <td>
                    {{ $sparePart->pivot->quantity }}
                </td>

                <td>
                    {{ $sparePart->unit }}
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4">
                    Belum ada spare part yang digunakan.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>


{{-- Add Spare Part --}}

<div class="card section">

    <h2>Tambah Spare Part</h2>

    <form
        action="{{ route('maintenance.spare-parts.store', $maintenance) }}"
        method="POST">

        @csrf

        <div class="form-group">

            <label for="spare_part_id">
                Spare Part
            </label>

            <select
                id="spare_part_id"
                name="spare_part_id"
                required>

                <option value="">
                    -- Pilih Spare Part --
                </option>

                @foreach ($spareParts as $sparePart)

                <option value="{{ $sparePart->id }}">

                    {{ $sparePart->code }}
                    -
                    {{ $sparePart->name }}

                    (Stock:
                    {{ $sparePart->stock }}
                    {{ $sparePart->unit }})

                </option>

                @endforeach

            </select>

        </div>


        <div class="form-group">

            <label for="quantity">
                Quantity
            </label>

            <input
                type="number"
                id="quantity"
                name="quantity"
                step="0.01"
                min="0.01"
                required>

        </div>


        <button type="submit" class="btn btn-primary">
            Tambahkan
        </button>

    </form>

</div>

@endsection