@extends('layouts.app')

@section('title', 'Edit Equipment')

@section('content')

<div class="page-header">

    <div>
        <h1>Edit Equipment</h1>

        <p class="page-description">
            Perbarui informasi equipment yang sudah terdaftar.
        </p>
    </div>

    <a href="{{ route('equipment.show', $equipment) }}"
        class="btn btn-secondary">
        ← Kembali
    </a>

</div>

<div class="card">

    <form
        method="POST"
        action="{{ route('equipment.update', $equipment) }}">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">
                Code
            </label>

            <input
                type="text"
                id="code"
                name="code"
                value="{{ old('code', $equipment->code) }}"
                required>
        </div>

        <div class="form-group">
            <label for="name">
                Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $equipment->name) }}"
                required>
        </div>

        <div class="form-group">
            <label for="type">
                Type
            </label>

            <input
                type="text"
                id="type"
                name="type"
                value="{{ old('type', $equipment->type) }}"
                required>
        </div>

        <div class="form-group">
            <label for="location">
                Location
            </label>

            <input
                type="text"
                id="location"
                name="location"
                value="{{ old('location', $equipment->location) }}"
                required>
        </div>

        <div class="form-group">
            <label for="status">
                Status
            </label>

            <select
                id="status"
                name="status"
                required>

                <option
                    value="operational"
                    {{ old('status', $equipment->status) === 'operational' ? 'selected' : '' }}>
                    Operational
                </option>

                <option
                    value="maintenance"
                    {{ old('status', $equipment->status) === 'maintenance' ? 'selected' : '' }}>
                    Maintenance
                </option>

                <option
                    value="inactive"
                    {{ old('status', $equipment->status) === 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>
        </div>

        <div class="form-group">
            <label for="purchase_date">
                Purchase Date
            </label>

            <input
                type="date"
                id="purchase_date"
                name="purchase_date"
                value="{{ old('purchase_date', $equipment->purchase_date?->format('Y-m-d')) }}">
        </div>

        <div class="form-group">
            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="4">{{ old('description', $equipment->description) }}</textarea>
        </div>

        <button
            type="submit"
            class="btn btn-primary">

            Update Equipment

        </button>

        <a
            href="{{ route('equipment.show', $equipment) }}"
            class="btn btn-secondary">

            Batal

        </a>

    </form>

</div>

@endsection