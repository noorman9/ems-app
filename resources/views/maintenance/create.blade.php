@extends('layouts.app')

@section('title', 'Tambah Maintenance')

@section('content')

<div class="page-header">
    <div>
        <h1>Tambah Maintenance</h1>

        <p class="page-description">
            Tambahkan jadwal maintenance baru untuk equipment.
        </p>
    </div>

    <a href="{{ route('maintenance.index') }}"
        class="btn btn-secondary">
        ← Kembali
    </a>
</div>

<div class="card">

    <form method="POST" action="{{ route('maintenance.store') }}">
        @csrf

        <div class="form-group">
            <label for="equipment_id">
                Equipment
            </label>

            <select
                id="equipment_id"
                name="equipment_id"
                required>

                <option value="">
                    -- Pilih Equipment --
                </option>

                @foreach ($equipment as $item)
                <option
                    value="{{ $item->id }}"
                    {{ old('equipment_id') == $item->id ? 'selected' : '' }}>

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

                <option value="">
                    -- Pilih Technician --
                </option>

                @foreach ($technicians as $technician)
                <option
                    value="{{ $technician->id }}"
                    {{ old('technician_id') == $technician->id ? 'selected' : '' }}>

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

                <option value="">
                    -- Pilih Type --
                </option>

                <option
                    value="preventive"
                    {{ old('type') === 'preventive' ? 'selected' : '' }}>
                    Preventive
                </option>

                <option
                    value="corrective"
                    {{ old('type') === 'corrective' ? 'selected' : '' }}>
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
                value="{{ old('scheduled_date') }}"
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
                step="0.01"
                min="0"
                value="{{ old('cost', 0) }}"
                required>
        </div>

        <div class="form-group">
            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="4">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Maintenance
        </button>

    </form>

</div>

@endsection