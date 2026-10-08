@extends('layouts.app')

@section('title', 'Tambah Stock Movement')

@section('content')

<div class="page-header">

    <div>
        <h1>Tambah Stock Movement</h1>

        <p class="page-description">
            Catat perubahan stock spare part.
        </p>
    </div>

    <a
        href="{{ route('stock-movements.index') }}"
        class="btn btn-secondary">

        ← Kembali

    </a>

</div>

<div class="card">

    <form
        action="{{ route('stock-movements.store') }}"
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

                <option
                    value="{{ $sparePart->id }}"
                    {{ old('spare_part_id') == $sparePart->id ? 'selected' : '' }}>

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
                    value="in"
                    {{ old('type') === 'in' ? 'selected' : '' }}>

                    Stock In

                </option>

                <option
                    value="out"
                    {{ old('type') === 'out' ? 'selected' : '' }}>

                    Stock Out

                </option>

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
                value="{{ old('quantity') }}"
                required>
        </div>

        <div class="form-group">
            <label for="note">
                Note
            </label>

            <textarea
                id="note"
                name="note"
                rows="4">{{ old('note') }}</textarea>
        </div>

        <button
            type="submit"
            class="btn btn-primary">

            Simpan Stock Movement

        </button>

        <a
            href="{{ route('stock-movements.index') }}"
            class="btn btn-secondary">

            Batal

        </a>

    </form>

</div>

@endsection