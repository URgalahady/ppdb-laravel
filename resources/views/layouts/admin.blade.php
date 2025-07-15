<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - PPDB SMKN 1 Manokwari</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5.3 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/ppdb.svg') }}">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <style>
        #sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s;
            z-index: 1;
        }

        #wrapper.toggled #sidebar {
            left: -250px;
        }

        #page-content-wrapper {
            width: 100%;
            padding-left: 250px;
            transition: all 0.3s;
        }

        #wrapper.toggled #page-content-wrapper {
            padding-left: 0;
        }

        #menu-toggle {
            border: none;
            background: none;
            font-size: 24px;
            color: #000;
        }

        /* Styling for Sidebar Links */
        .list-group-item {
            padding: 15px 20px;
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #343a40;
        }

        .btn-link {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        {{-- Sidebar --}}
        <div class="bg-dark text-white" id="sidebar">
            <div class="sidebar-header p-3">
                <h4 class="fw-bold">Admin PPDB</h4>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.pendaftaran.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-users"></i> Data Pendaftar
                </a>
                <a href="{{ route('admin.jurusan.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-layer-group"></i> Jurusan
                </a>
                <a href="{{ route('admin.gelombang.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-wave-square"></i> Gelombang
                </a>

                {{-- New Sidebar Links --}}
                <a href="{{ route('admin.pendaftaran.Status') }}" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="fas fa-filter"></i> Berdasarkan Status
                </a>
                <a href="{{ route('admin.pendaftaran.Gelombang') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-calendar"></i> Berdasarkan Gelombang
                </a>
            



                <form action="{{ route('logout') }}" method="POST" class="list-group-item list-group-item-action bg-dark text-white d-inline">
                    @csrf
                    <button class="btn btn-link text-white w-100">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- Page Content --}}
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-dark" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="#">Admin Panel</a>
                </div>
            </nav>

            {{-- Main Content --}}
            <div class="container py-4">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Custom JS --}}
    <script>
        // Toggle Sidebar
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('wrapper').classList.toggle('toggled');
        });
    </script>
</body>
</html>
