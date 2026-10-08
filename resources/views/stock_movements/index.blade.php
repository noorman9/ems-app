@extends('layouts.app')

@section('title', 'Stock Movement')

@section('content')

<div class="page-header">

    <div>
        <h1>Stock Movement History</h1>

        <p class="page-description">
            Riwayat perubahan stock spare part.
        </p>
    </div>

    <a
        href="{{ route('stock-movements.create') }}"
        class="btn btn-primary">

        + Tambah Stock Movement

    </a>

</div>

@if ($movements->isEmpty())

<div class="card">
    <p class="empty">
        Belum ada riwayat perubahan stock.
    </p>
</div>

@else

<div class="card">

    <table>

        <thead>
            <tr>
                <th>Date</th>
                <th>Spare Part</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>User</th>
                <th>Note</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($movements as $movement)

            <tr>

                <td>
                    {{ $movement->created_at->format('d-m-Y H:i') }}
                </td>

                <td>
                    {{ $movement->sparePart->code }}
                    -
                    {{ $movement->sparePart->name }}
                </td>

                <td>

                    @if ($movement->type === 'in')

                    <span class="badge badge-completed">
                        IN
                    </span>

                    @else

                    <span class="badge badge-maintenance">
                        OUT
                    </span>

                    @endif

                </td>

                <td>
                    {{ $movement->quantity }}
                    {{ $movement->sparePart->unit }}
                </td>

                <td>
                    {{ $movement->user->name }}
                </td>

                <td>
                    {{ $movement->note ?? '-' }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endif

@endsection