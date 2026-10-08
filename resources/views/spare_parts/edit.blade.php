@extends('layouts.app')

@section('title', 'Edit Spare Part')

@section('content')

<div class="page-header">

    <div>
        <h1>Edit Spare Part</h1>

        <p class="page-description">
            Perbarui informasi spare part tanpa mengubah stock secara langsung.
        </p>
    </div>

    <a
        href="{{ route('spare-parts.show', $sparePart) }}"
        class="btn btn-secondary">

        ← Kembali

    </a>

</div>

<div class="card">

    <form
        action="{{ route('spare-parts.update', $sparePart) }}"
        method="POST">

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
                value="{{ old('code', $sparePart->code) }}"
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
                value="{{ old('name', $sparePart->name) }}"
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
                value="{{ old('category', $sparePart->category) }}"
                required>
        </div>

        <div class="form-group">

            <label>
                Stock Saat Ini
            </label>

            <p>
                <strong>
                    {{ $sparePart->stock }}
                    {{ $sparePart->unit }}
                </strong>
            </p>

            <small>
                Stock hanya dapat diubah melalui Stock Movement.
            </small>

        </div>

        <div class="form-group">
            <label for="unit">
                Unit
            </label>

            <input
                type="text"
                id="unit"
                name="unit"
                value="{{ old('unit', $sparePart->unit) }}"
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
                value="{{ old('minimum_stock', $sparePart->minimum_stock) }}"
                required>
        </div>

        <div class="form-group">
            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="4">{{ old('description', $sparePart->description) }}</textarea>
        </div>

        <button
            type="submit"
            class="btn btn-primary">

            Update Spare Part

        </button>

        <a
            href="{{ route('spare-parts.show', $sparePart) }}"
            class="btn btn-secondary">

            Batal

        </a>

    </form>

</div>

@endsection