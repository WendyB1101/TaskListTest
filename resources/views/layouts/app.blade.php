<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager</title>
    <!-- MDB CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css">
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <style>
        body { font-family: 'Roboto', sans-serif; background: #f5f5f5; }

        .navbar-brand { font-weight: 700; letter-spacing: .5px; }

        .status-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 4px 12px; border-radius: 50px; font-size: .75rem; font-weight: 500;
        }
        .status-new         { background: #e3f2fd; color: #1565c0; }
        .status-in_progress { background: #fff8e1; color: #f57f17; }
        .status-done        { background: #e8f5e9; color: #2e7d32; }

        .task-card { transition: box-shadow .2s, transform .2s; }
        .task-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.12) !important; transform: translateY(-2px); }

        .page-header { background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
                       color: #fff; border-radius: 16px; padding: 2rem; margin-bottom: 2rem; }

        .fab { position: fixed; bottom: 2rem; right: 2rem; z-index: 999; }

        .table th { font-weight: 500; font-size: .8rem; text-transform: uppercase;
                    letter-spacing: .08em; color: #757575; }

        .avatar-icon { width: 40px; height: 40px; border-radius: 50%;
                       display: flex; align-items: center; justify-content: center;
                       background: #e3f2fd; color: #1976d2; font-size: 1.2rem; }

        .chip { display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px;
                border-radius: 50px; font-size: .78rem; font-weight: 500; cursor: pointer;
                border: 1.5px solid transparent; transition: all .15s; }
        .chip:hover { opacity: .85; }
        .chip-active { border-color: #1976d2 !important; }

        .snackbar { position: fixed; bottom: 1.5rem; left: 50%; transform: translateX(-50%);
                    background: #323232; color: #fff; padding: .75rem 1.5rem;
                    border-radius: 8px; z-index: 9999; animation: fadeUp .3s ease; }
        @keyframes fadeUp { from { opacity:0; transform: translate(-50%, 12px); }
                            to   { opacity:1; transform: translate(-50%, 0); } }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: #1976d2;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('tasks.index') }}">
            <span class="material-icons">task_alt</span> Task Manager
        </a>
        <a href="{{ route('tasks.create') }}" class="btn btn-light btn-sm d-flex align-items-center gap-1 ms-auto">
            <span class="material-icons" style="font-size:18px">add</span> Новая задача
        </a>
    </div>
</nav>

<div class="container py-4">
    @if(session('success'))
        <div class="snackbar" id="snackbar">
            <span class="material-icons me-2" style="font-size:18px;vertical-align:middle">check_circle</span>
            {{ session('success') }}
        </div>
        <script>setTimeout(() => document.getElementById('snackbar')?.remove(), 3000)</script>
    @endif

    @yield('content')
</div>

<!-- MDB JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>
</html>
