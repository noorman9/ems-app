@extends('layouts.app')

@section('title', 'Equipment')

@section('content')

<div class="page-header">

    <div>
        <h1>Equipment</h1>

        <p class="page-description">
            Daftar equipment yang terdaftar dalam sistem.
        </p>
    </div>

    <a href="{{ route('equipment.create') }}"
        class="btn btn-primary">
        + Tambah Equipment
    </a>

</div>

@if ($equipment->isEmpty())

<div class="card">
    <p class="empty">
        Belum ada equipment yang terdaftar.
    </p>
</div>

@else

<div class="card">

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Type</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($equipment as $item)

            <tr>
                <td>{{ $item->code }}</td>

                <td>{{ $item->name }}</td>

                <td>{{ $item->type }}</td>

                <td>{{ $item->location }}</td>

                <td>
                    <span class="badge badge-{{ $item->status }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>

                <td>
                    <a
                        href="{{ route('equipment.show', $item) }}"
                        class="btn btn-secondary">

                        Detail

                    </a>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

</div>

@endif

@endsection