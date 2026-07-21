<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">

        <h3 class="mb-4">CRM Admin</h3>

        <ul class="nav flex-column">

            <li class="nav-item mb-2">
                <a href="/admin/dashboard" class="nav-link text-white">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/admin/properties" class="nav-link text-white">
                    <i class="bi bi-house"></i> Properties
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/admin/agents" class="nav-link text-white">
                    <i class="bi bi-people"></i> Agents
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/admin/customers" class="nav-link text-white">
                    <i class="bi bi-person"></i> Customers
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/admin/bookings" class="nav-link text-white">
                    <i class="bi bi-journal-check"></i> Bookings
                </a>
            </li>

        </ul>

    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">

        <!-- Navbar -->
        <nav class="navbar navbar-light bg-light shadow-sm px-4">
            <span class="navbar-brand mb-0 h4">
                Super Admin Panel
            </span>
        </nav>

        <div class="container-fluid p-4">
            @yield('content')
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>