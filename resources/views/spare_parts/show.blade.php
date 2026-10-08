@extends('layouts.app')

@section('title', 'Detail Spare Part')

@section('content')

<div class="page-header">

    <div>
        <h1>Detail Spare Part</h1>

        <p class="page-description">
            Informasi lengkap spare part dan kondisi stock.
        </p>
    </div>

    <a
        href="{{ route('spare-parts.index') }}"
        class="btn btn-secondary">

        ← Kembali

    </a>

</div>

<div class="card">

    <table>

        <tr>
            <th>Code</th>
            <td>{{ $sparePart->code }}</td>
        </tr>

        <tr>
            <th>Name</th>
            <td>{{ $sparePart->name }}</td>
        </tr>

        <tr>
            <th>Category</th>
            <td>{{ $sparePart->category }}</td>
        </tr>

        <tr>
            <th>Stock</th>
            <td>

                @if ($sparePart->stock <= $sparePart->minimum_stock)

                    <span class="warning">
                        {{ $sparePart->stock }}
                        {{ $sparePart->unit }}
                    </span>

                    <span class="badge badge-maintenance">
                        Low Stock
                    </span>

                    @else

                    {{ $sparePart->stock }}
                    {{ $sparePart->unit }}

                    @endif

            </td>
        </tr>

        <tr>
            <th>Minimum Stock</th>
            <td>
                {{ $sparePart->minimum_stock }}
                {{ $sparePart->unit }}
            </td>
        </tr>

        <tr>
            <th>Description</th>
            <td>
                {{ $sparePart->description ?? '-' }}
            </td>
        </tr>

        <tr>
            <th>Created</th>
            <td>
                {{ $sparePart->created_at->format('d-m-Y H:i') }}
            </td>
        </tr>

        <tr>
            <th>Updated</th>
            <td>
                {{ $sparePart->updated_at->format('d-m-Y H:i') }}
            </td>
        </tr>

    </table>

</div>

<div style="margin-top: 20px;">

    <a
        href="{{ route('spare-parts.edit', $sparePart) }}"
        class="btn btn-primary">

        Edit

    </a>

</div>

@endsection