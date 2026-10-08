@extends('layouts.app')

@section('title', 'Tambah Equipment')

@section('content')

<div class="page-header">

    <div>
        <h1>Tambah Equipment</h1>

        <p class="page-description">
            Tambahkan equipment baru ke dalam sistem.
        </p>
    </div>

    <a href="{{ route('equipment.index') }}"
        class="btn btn-secondary">
        ← Kembali
    </a>

</div>

<div class="card">

    <form
        method="POST"
        action="{{ route('equipment.store') }}">

        @csrf

        <div class="form-group">
            <label for="code">
                Code
            </label>

            <input
                type="text"
                id="code"
                name="code"
                value="{{ old('code') }}"
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
                value="{{ old('name') }}"
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
                value="{{ old('type') }}"
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
                value="{{ old('location') }}"
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
                    {{ old('status', 'operational') === 'operational' ? 'selected' : '' }}>
                    Operational
                </option>

                <option
                    value="maintenance"
                    {{ old('status') === 'maintenance' ? 'selected' : '' }}>
                    Maintenance
                </option>

                <option
                    value="inactive"
                    {{ old('status') === 'inactive' ? 'selected' : '' }}>
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
                value="{{ old('purchase_date') }}">
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

        <button
            type="submit"
            class="btn btn-primary">

            Simpan Equipment

        </button>

    </form>

</div>

@endsection