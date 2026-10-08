@extends('layouts.app')

@section('title', 'Detail Equipment')

@section('content')

<div class="page-header">

    <div>
        <h1>Detail Equipment</h1>

        <p class="page-description">
            Informasi lengkap equipment yang terdaftar dalam sistem.
        </p>
    </div>

    <a href="{{ route('equipment.index') }}"
        class="btn btn-secondary">
        ← Kembali
    </a>

</div>

<div class="card">

    <table>

        <tr>
            <th>Code</th>
            <td>{{ $equipment->code }}</td>
        </tr>

        <tr>
            <th>Name</th>
            <td>{{ $equipment->name }}</td>
        </tr>

        <tr>
            <th>Type</th>
            <td>{{ $equipment->type }}</td>
        </tr>

        <tr>
            <th>Location</th>
            <td>{{ $equipment->location }}</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>
                <span class="badge badge-{{ $equipment->status }}">
                    {{ ucfirst($equipment->status) }}
                </span>
            </td>
        </tr>

        <tr>
            <th>Purchase Date</th>
            <td>
                {{ $equipment->purchase_date?->format('d-m-Y') ?? '-' }}
            </td>
        </tr>

        <tr>
            <th>Description</th>
            <td>
                {{ $equipment->description ?? '-' }}
            </td>
        </tr>

    </table>

</div>

<div style="margin-top: 20px;">

    <a
        href="{{ route('equipment.edit', $equipment) }}"
        class="btn btn-primary">

        Edit

    </a>

    <form
        method="POST"
        action="{{ route('equipment.destroy', $equipment) }}"
        style="display: inline;"
        onsubmit="return confirm('Yakin ingin menghapus equipment ini?')">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="btn btn-danger">

            Delete

        </button>

    </form>

</div>

@endsection