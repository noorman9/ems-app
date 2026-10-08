@extends('layouts.app')

@section('title', 'Tambah Spare Part')

@section('content')

<div class="page-header">

    <div>
        <h1>Tambah Spare Part</h1>

        <p class="page-description">
            Tambahkan spare part baru ke dalam sistem.
        </p>
    </div>

    <a
        href="{{ route('spare-parts.index') }}"
        class="btn btn-secondary">

        ← Kembali

    </a>

</div>

<div class="card">

    <form
        action="{{ route('spare-parts.store') }}"
        method="POST">

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
            <label for="category">
                Category
            </label>

            <input
                type="text"
                id="category"
                name="category"
                value="{{ old('category') }}"
                required>
        </div>

        <div class="form-group">
            <label for="stock">
                Initial Stock
            </label>

            <input
                type="number"
                id="stock"
                name="stock"
                step="0.01"
                min="0"
                value="{{ old('stock', 0) }}"
                required>
        </div>

        <div class="form-group">
            <label for="unit">
                Unit
            </label>

            <input
                type="text"
                id="unit"
                name="unit"
                value="{{ old('unit') }}"
                placeholder="Pcs, Liter, Kg, dll."
                required>
        </div>

        <div class="form-group">
            <label for="minimum_stock">
                Minimum Stock
            </label>

            <input
                type="number"
                id="minimum_stock"
                name="minimum_stock"
                step="0.01"
                min="0"
                value="{{ old('minimum_stock', 0) }}"
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

        <button
            type="submit"
            class="btn btn-primary">

            Simpan Spare Part

        </button>

        <a
            href="{{ route('spare-parts.index') }}"
            class="btn btn-secondary">

            Batal

        </a>

    </form>

</div>

@endsection