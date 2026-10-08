@extends('layouts.app')

@section('title', 'Edit Maintenance')

@section('content')

<div class="page-header">
    <div>
        <h1>Edit Maintenance</h1>

        <p class="page-description">
            Perbarui informasi maintenance yang sudah terdaftar.
        </p>
    </div>

    <a href="{{ route('maintenance.index') }}"
        class="btn btn-secondary">
        ← Kembali
    </a>
</div>

<div class="card">

    <form
        action="{{ route('maintenance.update', $maintenance) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="equipment_id">
                Equipment
            </label>

            <select
                id="equipment_id"
                name="equipment_id"
                required>

                @foreach ($equipment as $item)
                <option
                    value="{{ $item->id }}"
                    @selected($maintenance->equipment_id == $item->id)>

                    {{ $item->code }} - {{ $item->name }}

                </option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="technician_id">
                Technician
            </label>

            <select
                id="technician_id"
                name="technician_id"
                required>

                @foreach ($technicians as $technician)
                <option
                    value="{{ $technician->id }}"
                    @selected($maintenance->technician_id == $technician->id)>

                    {{ $technician->name }}

                </option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="type">
                Type
            </label>

            <select
                id="type"
                name="type"
                required>

                <option
                    value="preventive"
                    @selected($maintenance->type === 'preventive')>

                    Preventive

                </option>

                <option
                    value="corrective"
                    @selected($maintenance->type === 'corrective')>

                    Corrective

                </option>

            </select>
        </div>

        <div class="form-group">
            <label for="scheduled_date">
                Scheduled Date
            </label>

            <input
                type="date"
                id="scheduled_date"
                name="scheduled_date"
                value="{{ $maintenance->scheduled_date->format('Y-m-d') }}"
                required>
        </div>

        <div class="form-group">
            <label for="cost">
                Cost
            </label>

            <input
                type="number"
                id="cost"
                name="cost"
                min="0"
                step="0.01"
                value="{{ $maintenance->cost }}"
                required>
        </div>

        <div class="form-group">
            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="4">{{ $maintenance->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Update Maintenance
        </button>

        <a
            href="{{ route('maintenance.index') }}"
            class="btn btn-secondary">

            Batal

        </a>

    </form>

</div>

@endsection