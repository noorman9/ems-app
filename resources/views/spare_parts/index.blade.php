@extends('layouts.app')

@section('title', 'Spare Parts')

@section('content')

<div class="page-header">

    <div>
        <h1>Spare Parts</h1>

        <p class="page-description">
            Daftar spare part dan kondisi stock yang tersedia.
        </p>
    </div>

    <a
        href="{{ route('spare-parts.create') }}"
        class="btn btn-primary">

        + Tambah Spare Part

    </a>

</div>

@if ($spareParts->isEmpty())

<div class="card">
    <p class="empty">
        Belum ada spare part yang terdaftar.
    </p>
</div>

@else

<div class="card">

    <table>

        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Unit</th>
                <th>Minimum Stock</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($spareParts as $sparePart)

            <tr>

                <td>{{ $sparePart->code }}</td>

                <td>{{ $sparePart->name }}</td>

                <td>{{ $sparePart->category }}</td>

                <td>
                    @if ($sparePart->stock <= $sparePart->minimum_stock)
                        <span class="warning">
                            {{ $sparePart->stock }}
                        </span>
                        @else
                        {{ $sparePart->stock }}
                        @endif
                </td>

                <td>{{ $sparePart->unit }}</td>

                <td>{{ $sparePart->minimum_stock }}</td>

                <td>

                    <a
                        href="{{ route('spare-parts.show', $sparePart) }}"
                        class="btn btn-secondary">

                        Detail

                    </a>

                    <form
                        action="{{ route('spare-parts.destroy', $sparePart) }}"
                        method="POST"
                        style="display: inline;"
                        onsubmit="return confirm('Yakin ingin menghapus spare part ini?')">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endif

@endsection