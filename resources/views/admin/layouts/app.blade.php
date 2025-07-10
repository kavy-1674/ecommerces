<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Zestora</title>
    <script src="{{ asset('js/toaster.js') }}"></script>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            overflow-x: hidden;

        }
        
        /* Header styles */
        .header {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 40;
            height: 64px;
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 1rem;
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .sidebar-toggle {
            padding: 0.5rem;
            border-radius: 0.5rem;
            background: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .sidebar-toggle:hover {
            background-color: #f3f4f6;
        }
        
        .logo {
            font-size: 1.25rem;
            font-weight: bold;
            color: #dc2626;
            text-decoration: none;
        }
        
        .notification-btn {
            position: relative;
            padding: 0.5rem;
            border-radius: 0.5rem;
            background: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .notification-btn:hover {
            background-color: #f3f4f6;
        }
        
        .notification-badge {
            position: absolute;
            top: -0.25rem;
            right: -0.25rem;
            background: #dc2626;
            color: white;
            font-size: 0.75rem;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .profile-section {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .profile-avatar {
            width: 32px;
            height: 32px;
            background: #dc2626;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .profile-name {
            color: #374151;
            font-weight: 500;
        }
        
        /* Sidebar styles */
        .sidebar {
            background: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: fixed;
            left: 0;
            top: 64px;
            height: calc(100vh - 64px);
            z-index: 30;
            transition: width 0.3s ease-in-out;
        }
        
        .sidebar-expanded {
            width: 250px;
        }
        
        .sidebar-collapsed {
            width: 70px;
        }
        
        .sidebar-nav {
            padding: 1rem;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: 0.5rem;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
            margin-bottom: 0.5rem;
        }
        
        .nav-item:hover {
            background-color: rgba(220, 38, 38, 0.1);
            color: #dc2626;
        }
        
        .nav-item.active {
            background-color: rgba(220, 38, 38, 0.15);
            border-right: 3px solid #dc2626;
        }
        
        .nav-icon {
            width: 1.5rem;
            height: 1.5rem;
        }
        
        .sidebar-text {
            font-weight: 500;
        }
        
        /* Products toggle styles */
        .products-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            cursor: pointer;
        }
        
        .products-toggle-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .products-submenu {
            margin-left: 1.5rem;
            margin-top: 0.5rem;
        }
        
        .submenu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }
        
        .submenu-item:hover {
            color: #dc2626;
            background-color: #fef2f2;
        }
        
        .submenu-item.active {
            background-color: rgba(220, 38, 38, 0.1);
            border-left: 3px solid #dc2626;
            color: #dc2626;
        }
        
        /* Main content styles */
        .main-content {
            transition: margin-left 0.3s ease-in-out;
            padding-top: 64px;
            min-height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
        
        .content-expanded {
            margin-left: 250px;
        }
        
        .content-collapsed {
            margin-left: 70px;
        }
        
        /* Utility classes */
        .hidden {
            display: none !important;
        }
        
        .flex {
            display: flex;
        }
        
        .items-center {
            align-items: center;
        }
        
        .justify-between {
            justify-content: space-between;
        }
        
        .space-x-3 > * + * {
            margin-left: 0.75rem;
        }
        
        .space-x-4 > * + * {
            margin-left: 1rem;
        }
        
        .space-x-2 > * + * {
            margin-left: 0.5rem;
        }
        
        .gap-1 {
            gap: 0.25rem;
        }
        
        .gap-2 {
            gap: 0.5rem;
        }
        
        .gap-4 {
            gap: 1rem;
        }
        
        .p-2 {
            padding: 0.5rem;
        }
        
        .p-3 {
            padding: 0.75rem;
        }
        
        .p-4 {
            padding: 1rem;
        }
        
        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        
        .py-8 {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        
        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        
        .pb-6 {
            padding-bottom: 1.5rem;
        }
        
        .mt-8 {
            margin-top: 2rem;
        }
        
        .mt-16 {
            margin-top: 4rem;
        }
        
        .mb-4 {
            margin-bottom: 1rem;
        }
        
        .mb-6 {
            margin-bottom: 1.5rem;
        }
        
        .ml-6 {
            margin-left: 1.5rem;
        }
        
        .mt-2 {
            margin-top: 0.5rem;
        }
        
        .mr-2 {
            margin-right: 0.5rem;
        }
        
        .w-full {
            width: 100%;
        }
        
        .max-w-4xl {
            max-width: 56rem;
        }
        
        .max-w-6xl {
            max-width: 72rem;
        }
        
        .text-lg {
            font-size: 1.125rem;
        }
        
        .text-xl {
            font-size: 1.25rem;
        }
        
        .text-sm {
            font-size: 0.875rem;
        }
        
        .text-xs {
            font-size: 0.75rem;
        }
        
        .font-semibold {
            font-weight: 600;
        }
        
        .font-medium {
            font-weight: 500;
        }
        
        .font-bold {
            font-weight: 700;
        }
        
        .text-red-600 {
            color: #dc2626;
        }
        
        .text-gray-700 {
            color: #374151;
        }
        
        .text-gray-600 {
            color: #4b5563;
        }
        
        .text-gray-500 {
            color: #6b7280;
        }
        
        .text-white {
            color: white;
        }
        
        .bg-red-600 {
            background-color: #dc2626;
        }
        
        .bg-white {
            background-color: white;
        }
        
        .bg-gray-100 {
            background-color: #f3f4f6;
        }
        
        .rounded-lg {
            border-radius: 0.5rem;
        }
        
        .rounded-full {
            border-radius: 9999px;
        }
        
        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .transition {
            transition: all 0.2s ease-in-out;
        }
        
        .transition-colors {
            transition: color 0.2s ease-in-out, background-color 0.2s ease-in-out;
        }
        
        .transition-all {
            transition: all 0.3s ease-in-out;
        }
        
        .duration-300 {
            transition-duration: 0.3s;
        }
        
        .hover\:bg-gray-100:hover {
            background-color: #f3f4f6;
        }
        
        .hover\:text-red-600:hover {
            color: #dc2626;
        }
        
        .hover\:bg-red-50:hover {
            background-color: #fef2f2;
        }
        
        .hover\:underline:hover {
            text-decoration: underline;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .justify-center {
            justify-content: center;
        }
        
        .justify-end {
            justify-content: flex-end;
        }
        
        .space-y-6 > * + * {
            margin-top: 1.5rem;
        }
        
        .space-y-2 > * + * {
            margin-top: 0.5rem;
        }
        
        .space-y-1 > * + * {
            margin-top: 0.25rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .content-expanded,
            .content-collapsed {
                margin-left: 0;
            }
            
            .sidebar-expanded {
                width: 250px;
            }
            
            .sidebar-collapsed {
                width: 0;
                overflow: hidden;
            }
        }
        
        /* Sidebar collapsed states */
        .sidebar-collapsed .sidebar-text {
            display: none !important;
        }
        
        .sidebar-collapsed .nav-item {
            justify-content: center;
            padding: 0.75rem;
        }
        
        .sidebar-collapsed .nav-item svg {
            margin: 0;
        }
        
        .sidebar-collapsed #products-arrow {
            display: none;
        }
        
        .sidebar-collapsed #products-submenu {
            display: none !important;
        }
        
        .sidebar-collapsed #products-toggle {
            justify-content: center;
            padding: 0.75rem;
        }
        
        .sidebar-collapsed #products-toggle > div {
            justify-content: center;
        }
        
        .sidebar-collapsed .products-icon {
            display: block !important;
            width: 1.5rem !important;
            height: 1.5rem !important;
            margin: 0 !important;
        }
        
        .sidebar-collapsed .nav-item {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.75rem;
            width: 100%;
        }
        
        .sidebar-collapsed .nav-item > * {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        
        .sidebar-collapsed .nav-item svg {
            width: 1.5rem;
            height: 1.5rem;
            margin: 0;
        }
        
        .content-transition {
            transition: margin-left 0.3s ease-in-out;
        }
        
        .content-collapsed {
            margin-left: 70px;
        }
        
        .content-expanded {
            margin-left: 250px;
        }
        
        .nav-item {
            transition: all 0.2s ease-in-out;
        }
        
        .nav-item:hover {
            background-color: rgba(239, 68, 68, 0.1);
        }
        
        .nav-item.active {
            background-color: rgba(239, 68, 68, 0.15);
            border-right: 3px solid #dc2626;
        }
        
        .submenu-item.active {
            background-color: rgba(239, 68, 68, 0.1);
            border-left: 3px solid #dc2626;
            color: #dc2626;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <!-- Left side -->
            <div class="header-left">
                <button id="sidebar-toggle" class="sidebar-toggle">
                    <svg class="nav-icon text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <a href="{{ route('/') }}"><div class="logo">Zestora Admin</div></a>
            </div>
            
            <!-- Right side -->
            <div class="header-right">
                <!-- Notifications -->
                <button class="notification-btn">
                    <svg class="nav-icon text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM10.5 3.75a6 6 0 00-6 6v3.75a6 6 0 0012 0V9.75a6 6 0 00-6-6z"></path>
                    </svg>
                    <span class="notification-badge">3</span>
                </button>
                
                <!-- Profile -->
                <div class="profile-section">
                    <div class="profile-avatar">A</div>
                    <span class="profile-name">Admin</span>
                    <svg class="nav-icon text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar sidebar-transition sidebar-expanded">
        <nav class="sidebar-nav">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboards') }}" class="nav-item {{ request()->routeIs('admin.dashboards') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                </svg>
                <span class="sidebar-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.product-manage') }}" class="nav-item {{ request()->routeIs('admin.product-manage') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 7l9-4 9 4-9 4-9-4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 17l9 4 9-4" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l9 4 9-4" />
                  </svg>
                  
                  
                <span class="sidebar-text">Add Product</span>
            </a>            

            <!-- Orders -->
            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="sidebar-text">Orders</span>
            </a>

            <!-- Customers -->
            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                <span class="sidebar-text">Customers</span>
            </a>

            <!-- Analytics -->
            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="sidebar-text">Analytics</span>
            </a>

            <!-- Settings -->
            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="sidebar-text">Settings</span>
            </a>
        </nav>
    </aside>
    
    <!-- Main Content -->
    <main id="main-content" class="main-content content-transition content-expanded">
        @yield('content')
    </main>
    
    <script>
        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        
        let isSidebarCollapsed = false;

        function toggleSidebar() {
            isSidebarCollapsed = !isSidebarCollapsed;
            
            if (isSidebarCollapsed) {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                mainContent.classList.remove('content-expanded');
                mainContent.classList.add('content-collapsed');
                
                // Hide submenu when collapsing
                if (productsSubmenu) {
                    productsSubmenu.classList.add('hidden');
                    productsArrow.style.transform = 'rotate(0deg)';
                    isProductsOpen = false;
                }
            } else {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
                mainContent.classList.remove('content-collapsed');
                mainContent.classList.add('content-expanded');
            }
        }

        // Event listeners
        sidebarToggle.addEventListener('click', toggleSidebar);

        // Active nav item functionality
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                navItems.forEach(nav => nav.classList.remove('active'));
                // Add active class to clicked item
                this.classList.add('active');
            });
        });

        // Products submenu toggle functionality
        const productsToggle = document.getElementById('products-toggle');
        const productsSubmenu = document.getElementById('products-submenu');
        const productsArrow = document.getElementById('products-arrow');
        let isProductsOpen = false;

        productsToggle.addEventListener('click', function() {
            // Don't toggle submenu if sidebar is collapsed
            if (isSidebarCollapsed) {
                return;
            }
            
            isProductsOpen = !isProductsOpen;
            
            if (isProductsOpen) {
                productsSubmenu.classList.remove('hidden');
                productsArrow.style.transform = 'rotate(180deg)';
            } else {
                productsSubmenu.classList.add('hidden');
                productsArrow.style.transform = 'rotate(0deg)';
            }
        });

        // Submenu item click functionality
        const submenuItems = document.querySelectorAll('.submenu-item');
        submenuItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all submenu items
                submenuItems.forEach(subItem => subItem.classList.remove('active'));
                // Add active class to clicked item
                this.classList.add('active');
            });
        });

        // Responsive behavior
        function handleResize() {
            if (window.innerWidth < 768) {
                // On mobile, collapse sidebar by default
                if (!isSidebarCollapsed) {
                    toggleSidebar();
                }
            }
        }

        window.addEventListener('resize', handleResize);
        
        // Initialize responsive behavior
        handleResize();
    </script>
    @if(session('toast'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toast = @json(session('toast'));
                if (window.toaster && toast?.type && toast?.message) {
                    toaster[toast.type](toast.message);
                }
            });
        </script>
    @endif
        @stack('scripts')

</body>
</html>