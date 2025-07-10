@extends('admin.layouts.app')

@section('content')
<style>
    .dashboard-container {
        padding: 2rem;
        max-width: 85%;
        transition: all 0.3s ease;
        margin: 0 auto;
        width: 100%;
    }
    
    /* When sidebar is collapsed, increase width */
    .content-collapsed .dashboard-container {
        margin-left: 20px;
        max-width: 95%;
    }
    
    /* When sidebar is expanded, keep width smaller */
    .content-expanded .dashboard-container {
        margin-left: 5px;
        max-width: 85%;
    }
    
    .dashboard-header {
        margin-bottom: 2rem;
    }
    
    .dashboard-title {
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .dashboard-subtitle {
        color: #6b7280;
        font-size: 1rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border-left: 4px solid #dc2626;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card.blue {
        border-left-color: #3b82f6;
    }
    
    .stat-card.green {
        border-left-color: #10b981;
    }
    
    .stat-card.yellow {
        border-left-color: #f59e0b;
    }
    
    .stat-card.purple {
        border-left-color: #8b5cf6;
    }
    
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .stat-title {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .stat-icon {
        width: 2rem;
        height: 2rem;
        padding: 0.5rem;
        border-radius: 8px;
        background: rgba(220, 38, 38, 0.1);
        color: #dc2626;
    }
    
    .stat-icon.blue {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    
    .stat-icon.green {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    
    .stat-icon.yellow {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }
    
    .stat-icon.purple {
        background: rgba(139, 92, 246, 0.1);
        color: #8b5cf6;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }
    
    .stat-change {
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .stat-change.positive {
        color: #10b981;
    }
    
    .stat-change.negative {
        color: #ef4444;
    }
    
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .recent-orders {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .order-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .order-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .order-avatar {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }
    
    .order-details h4 {
        font-size: 0.875rem;
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }
    
    .order-details p {
        font-size: 0.75rem;
        color: #6b7280;
    }
    
    .order-status {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }
    
    .status-completed {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    
    .status-processing {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    
    .quick-actions {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .action-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
        margin-bottom: 0.5rem;
    }
    
    .action-item:hover {
        background: #f9fafb;
    }
    
    .action-icon {
        width: 2rem;
        height: 2rem;
        padding: 0.5rem;
        border-radius: 8px;
        background: rgba(220, 38, 38, 0.1);
        color: #dc2626;
    }
    
    .action-text {
        font-size: 0.875rem;
        font-weight: 500;
        color: #1f2937;
    }
    
    .chart-container {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }
    
    .chart-placeholder {
        height: 300px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 1rem;
    }
    
    /* Responsive design */
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .stat-card {
            padding: 1rem;
        }
        
        .stat-value {
            font-size: 1.5rem;
        }
    }
</style>

<div class="dashboard-container" ">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard</h1>
        <p class="dashboard-subtitle">Welcome back! Here's what's happening with your store today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid" >
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Sales</span>
                <div class="stat-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-value">₹45,231</div>
            <div class="stat-change positive">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                +20.1% from last month
            </div>
        </div>

        <div class="stat-card blue">
            <div class="stat-header">
                <span class="stat-title">Total Orders</span>
                <div class="stat-icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-value">2,350</div>
            <div class="stat-change positive">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                +15.3% from last month
            </div>
        </div>

        <div class="stat-card green">
            <div class="stat-header">
                <span class="stat-title">Total Products</span>
                <div class="stat-icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-value">1,234</div>
            <div class="stat-change positive">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                +8.2% from last month
            </div>
        </div>

        <div class="stat-card yellow">
            <div class="stat-header">
                <span class="stat-title">Total Customers</span>
                <div class="stat-icon yellow">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-value">892</div>
            <div class="stat-change positive">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                +12.5% from last month
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Recent Orders -->
        <div class="recent-orders">
            <h3 class="section-title">Recent Orders</h3>
            <div class="order-item">
                <div class="order-info">
                    <div class="order-avatar">JD</div>
                    <div class="order-details">
                        <h4>John Doe</h4>
                        <p>Order #12345 • 2 items</p>
                    </div>
                </div>
                <span class="order-status status-pending">Pending</span>
            </div>
            <div class="order-item">
                <div class="order-info">
                    <div class="order-avatar">JS</div>
                    <div class="order-details">
                        <h4>Jane Smith</h4>
                        <p>Order #12344 • 1 item</p>
                    </div>
                </div>
                <span class="order-status status-completed">Completed</span>
            </div>
            <div class="order-item">
                <div class="order-info">
                    <div class="order-avatar">MJ</div>
                    <div class="order-details">
                        <h4>Mike Johnson</h4>
                        <p>Order #12343 • 3 items</p>
                    </div>
                </div>
                <span class="order-status status-processing">Processing</span>
            </div>
            <div class="order-item">
                <div class="order-info">
                    <div class="order-avatar">SB</div>
                    <div class="order-details">
                        <h4>Sarah Brown</h4>
                        <p>Order #12342 • 1 item</p>
                    </div>
                </div>
                <span class="order-status status-completed">Completed</span>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h3 class="section-title">Quick Actions</h3>
            <div class="action-item">
                <div class="action-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <span class="action-text">Add New Product</span>
            </div>
            <div class="action-item">
                <div class="action-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="action-text">View Orders</span>
            </div>
            <div class="action-item">
                <div class="action-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <span class="action-text">Manage Customers</span>
            </div>
            <div class="action-item">
                <div class="action-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <span class="action-text">View Analytics</span>
            </div>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="chart-container">
        <h3 class="section-title">Sales Overview</h3>
        <div class="chart-placeholder">
            Chart will be displayed here
        </div>
    </div>
</div>

<script>
    // Add click handlers for quick actions
    document.querySelectorAll('.action-item').forEach(item => {
        item.addEventListener('click', function() {
            const actionText = this.querySelector('.action-text').textContent;
            
            if (actionText === 'Add New Product') {
                window.location.href = '{{ route("admin.add-product") }}';
            } else if (actionText === 'View Orders') {
                // Add order route when available
                console.log('Navigate to orders');
            } else if (actionText === 'Manage Customers') {
                // Add customer route when available
                console.log('Navigate to customers');
            } else if (actionText === 'View Analytics') {
                // Add analytics route when available
                console.log('Navigate to analytics');
            }
        });
    });
</script>
@endsection