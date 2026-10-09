<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'EMS')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
        }

        /* =========================
   Navbar
========================= */

        .navbar {
            background: #1f2937;
            color: white;
        }

        .navbar-container {
            max-width: 1200px;
            min-height: 64px;
            margin: 0 auto;
            padding: 0 30px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            color: white;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .nav-links a {
            color: #d1d5db;
            text-decoration: none;
        }

        .nav-links a:hover {
            color: white;
        }

        .nav-links button {
            border: none;
            background: none;
            padding: 0;

            color: #d1d5db;
            font-size: 14px;

            cursor: pointer;
        }

        .nav-links button:hover {
            color: white;
        }


        .nav-links a.active {
            color: #ffffff;
            background: #374151;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: bold;
        }

        .nav-links a {
            padding: 8px 12px;
            border-radius: 6px;
            transition: background 0.2s ease;
        }

        .nav-links a:hover {
            color: white;
            background: #374151;
        }


        /* =========================
   Layout
========================= */

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        /* =========================
   Card
========================= */

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        /* =========================
   Buttons
========================= */

        .btn {
            display: inline-block;
            padding: 9px 14px;
            border: none;
            border-radius: 6px;

            font-size: 14px;
            text-decoration: none;

            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-success {
            background: #16a34a;
            color: white;
        }

        .btn-success:hover {
            background: #15803d;
        }

        /* =========================
   Page Header
========================= */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0 0 6px;
        }

        .page-description {
            margin: 0;
            color: #6b7280;
        }

        /* =========================
   Status Badge
========================= */

        .badge {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 999px;

            font-size: 12px;
            font-weight: bold;
        }

        .badge-operational {
            background: #dcfce7;
            color: #166534;
        }

        .badge-maintenance {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        /* =========================
   Maintenance Status
========================= */

        .badge-scheduled {
            background: #e0e7ff;
            color: #3730a3;
        }

        .badge-in-progress {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-completed {
            background: #dcfce7;
            color: #166534;
        }

        /* =========================
   Forms
========================= */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            max-width: 500px;

            padding: 9px 11px;

            border: 1px solid #d1d5db;
            border-radius: 6px;

            font-size: 14px;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        /* =========================
   Alert
========================= */

        .alert {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* =========================
   Dashboard
========================= */

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 8px;
        }

        .header p {
            margin: 0;
            color: #6b7280;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card-title {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .card-value {
            font-size: 30px;
            font-weight: bold;
        }

        .section-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .section h2 {
            margin-top: 0;
            font-size: 18px;
        }

        .status-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .status-item:last-child {
            border-bottom: none;
        }

        .low-stock {
            background: #fff7ed;
            border: 1px solid #fed7aa;
        }

        .low-stock-item {
            padding: 12px 0;
            border-bottom: 1px solid #fed7aa;
        }

        .low-stock-item:last-child {
            border-bottom: none;
        }

        .warning {
            color: #c2410c;
            font-weight: bold;
        }

        .empty {
            color: #6b7280;
        }

        /* =========================
   Table
========================= */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            font-size: 13px;
            color: #6b7280;
        }

        /* =========================
   Responsive
========================= */

        @media (max-width: 800px) {
            .summary {
                grid-template-columns: repeat(2, 1fr);
            }

            .section-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                gap: 10px;
            }
        }

        @media (max-width: 600px) {
            .navbar-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 15px 20px;
            }

            .nav-links {
                flex-wrap: wrap;
            }

            .container {
                padding: 20px;
            }
        }

        @media (max-width: 500px) {
            .summary {
                grid-template-columns: 1fr;
            }
        }


        /* Dashboard improvement */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 28px;
        }

        .dashboard-header h1 {
            margin: 0 0 8px;
        }

        .dashboard-date {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 12px 16px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            white-space: nowrap;
        }

        .dashboard-date span,
        .summary-caption,
        .section-description,
        .table-secondary {
            color: #6b7280;
            font-size: 13px;
        }

        .dashboard-date strong {
            font-size: 14px;
        }

        .summary-card {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .summary-icon {
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 13px;
            font-weight: bold;
        }

        .icon-equipment {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .icon-maintenance {
            background: #fef3c7;
            color: #92400e;
        }

        .icon-spare-parts {
            background: #dcfce7;
            color: #166534;
        }

        .icon-users {
            background: #ede9fe;
            color: #6d28d9;
        }

        .summary-card .card-value {
            margin-bottom: 4px;
        }

        .summary-caption {
            font-size: 12px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .section-heading h2 {
            margin: 0 0 6px;
        }

        .section-description {
            margin: 0;
        }

        .status-item>span {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .status-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
        }

        .dot-scheduled {
            background: #6366f1;
        }

        .dot-progress {
            background: #f59e0b;
        }

        .dot-completed {
            background: #16a34a;
        }

        .alert-label {
            padding: 5px 9px;
            border-radius: 6px;
            background: #ffedd5;
            color: #9a3412;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .low-stock-name {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 10px;
        }

        .stock-progress {
            height: 6px;
            margin-bottom: 8px;
            overflow: hidden;
            background: #fed7aa;
            border-radius: 999px;
        }

        .stock-progress-bar {
            height: 100%;
            width: var(--stock-percentage, 0%);
            background: #ea580c;
            border-radius: 999px;
        }

        .low-stock-item small {
            color: #9a3412;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .table-secondary {
            margin-top: 4px;
        }

        .table-empty {
            padding: 24px;
            text-align: center;
        }

        @media (max-width: 800px) {
            .dashboard-header {
                align-items: flex-start;
            }

            .summary-card {
                align-items: flex-start;
            }
        }

        @media (max-width: 500px) {
            .dashboard-header {
                flex-direction: column;
            }

            .dashboard-date {
                width: 100%;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">

        <div class="navbar-container">

            <a href="{{ route('dashboard') }}" class="brand">
                EMS
            </a>

            <div class="nav-links">

                <a
                    href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a
                    href="{{ route('equipment.index') }}"
                    class="{{ request()->routeIs('equipment.*') ? 'active' : '' }}">
                    Equipment
                </a>

                <a
                    href="{{ route('maintenance.index') }}"
                    class="{{ request()->routeIs('maintenance.*') ? 'active' : '' }}">
                    Maintenance
                </a>

                <a
                    href="{{ route('spare-parts.index') }}"
                    class="{{ request()->routeIs('spare-parts.*') ? 'active' : '' }}">
                    Spare Parts
                </a>

                <a
                    href="{{ route('stock-movements.index') }}"
                    class="{{ request()->routeIs('stock-movements.*') ? 'active' : '' }}">
                    Stock
                </a>

                <form action="{{ url('/logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>

            </div>
        </div>

    </nav>

    <main class="container">

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @yield('content')

    </main>

</body>

</html>