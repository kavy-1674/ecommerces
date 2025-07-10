@extends('admin.layouts.app')

@section('content')
<style>
    .product-main-container {
        
    width: 85%;
    /* max-width: 1200px; */
    margin-top: 2rem;
    margin-bottom: 2rem;
    margin-left: 15px;
    margin-right: auto;
    padding: 2rem 1rem;
    border-radius: 12px;
    transition: width 0.3s cubic-bezier(0.4,0,0.2,1), max-width 0.3s cubic-bezier(0.4,0,0.2,1), margin 0.3s cubic-bezier(0.4,0,0.2,1);
}
.sidebar-closed .product-main-container {
    width: 98%;
    max-width: 1430px;
    margin-left: 0;
}
.sidebar-open .product-main-container {
    width: 85%;
    max-width: 1250px;
    margin-left: 10px;
}
    .filter-bar {
        margin-bottom: 1.5rem;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(220,38,38,0.04);
        padding: 1.5rem 2rem;
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        align-items: flex-end;
        width: 100%;
    }
    .filter-bar label {
        font-weight: 500;
        color: #dc2626;
    }
    .filter-bar input[type="text"],
    .filter-bar input[type="number"],
    .filter-bar select {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #f3f4f6;
        border-radius: 6px;
        margin-top: 0.3rem;
    }
    .filter-bar button {
        background: #dc2626;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        cursor: pointer;
    }
    .filter-bar button.reset {
        background: #f3f4f6;
        color: #dc2626;
        margin-left: 0.5rem;
    }
    .product-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(220,38,38,0.04);
        margin-top: 1.5rem;
    }
    .product-table th, .product-table td {
        padding: 1rem 1.25rem;
        text-align: left;
        color: #374151;
    }
    .product-table th {
        background: #fef2f2;
        color: #dc2626;
        font-weight: 600;
        border-bottom: 2px solid #f3f4f6;
    }
    .product-table tbody tr {
        transition: background 0.2s;
    }
    .product-table tbody tr:hover {
        background: #f3f4f6;
    }
    .product-table td {
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    .product-image {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #f3f4f6;
        background: #fef2f2;
    }
    .action-btn {
        border: none;
        background: none;
        cursor: pointer;
        padding: 0.4rem 0.7rem;
        border-radius: 6px;
        font-size: 1rem;
        margin-right: 0.3rem;
        transition: background 0.2s, color 0.2s;
    }
    .action-btn.edit {
        color: #10b981;
    }
    .action-btn.edit:hover {
        background: #d1fae5;
    }
    .action-btn.delete {
        color: #dc2626;
    }
    .action-btn.delete:hover {
        background: #fee2e2;
    }
    @media (max-width: 900px) {
        .filter-bar { flex-direction: column; padding: 1rem; }
        .filter-bar > div { width: 100%; }
        .filter-bar button { width: 100%; margin-top: 0.5rem; }
        .product-table th, .product-table td { padding: 0.5rem; }
    }
    .custom-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }
    .custom-pagination nav {
        display: flex;
        gap: 0.5rem;
    }
    .custom-pagination .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .custom-pagination .pagination li {
        display: inline-block;
    }
    .custom-pagination .pagination li a,
    .custom-pagination .pagination li span {
        display: inline-block;
        min-width: 36px;
        padding: 0.5rem 0.9rem;
        border-radius: 8px;
        background: #fff;
        color: #dc2626;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        border: 1px solid #f3f4f6;
        transition: background 0.2s, color 0.2s, border 0.2s;
    }
    .custom-pagination .pagination li.active span,
    .custom-pagination .pagination li span[aria-current="page"] {
        background: #dc2626;
        color: #fff;
        border: 1px solid #dc2626;
    }
    .custom-pagination .pagination li a:hover {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #dc2626;
    }
    .custom-pagination .pagination li.disabled span,
    .custom-pagination .pagination li.disabled a {
        color: #9ca3af;
        background: #f3f4f6;
        border: 1px solid #f3f4f6;
        cursor: not-allowed;
    }
</style>
<body class="sidebar-open">
    <!-- Sidebar code -->
    <div class="product-main-container" id="product-list">
        
        <!-- Filter Bar -->
        <div class="filter-bar">
            <div style="flex: 1 1 300px;">
                <label for="filter-name">Product Name</label>
                <input type="text" id="filter-name" placeholder="Search by name...">
            </div>
            <div style="flex: 1 1 300px; min-width: 250px;">
                <label for="filter-category">Category</label>
                <select id="filter-category">
                    <option value="">All</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Footwear">Footwear</option>
                    <option value="Books">Books</option>
                    <option value="Audio">Audio</option>
                </select>
            </div>

            <div style="flex: 1 1 120px;">
                <label for="filter-price-min">Min Price</label>
                <input type="number" id="filter-price-min" placeholder="Min">
            </div>
            <div style="flex: 1 1 120px;">
                <label for="filter-price-max">Max Price</label>
                <input type="number" id="filter-price-max" placeholder="Max">
            </div>
            <div style="flex: 0 0 auto; display: flex; gap: 0.5rem;">
                <button id="filter-apply">Search</button>
                <button class="reset" id="filter-reset">Reset</button>
            </div>
        </div>

        
    <!-- Product Table -->
    <table class="product-table">
        <thead>
            <tr>
                <th><input type="checkbox" /></th>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>            
                <th>Category</th>
                <th>Sale Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>{{ ucfirst($product->id) }}</td>
                    <td>
                        @php
                            $firstImage = $product->product_images[0] ?? 'uploads/products/default.png';
                        @endphp
                        <img src="{{ asset('storage/' . $firstImage) }}" onerror="this.src='{{ asset('storage/uploads/products/default.png') }}'" class="product-image" alt="Product" />

                    </td>
                    <td>{{ ucfirst(strtolower($product->product_name)) }}</td>
                    <td>{{ ucfirst($product->category) }}</td>
                    <td style="color: #10b981; font-weight: 600;">₹{{ $product->sale_price }}</td>
                    <td>
                        <button class="action-btn edit">{{ ucfirst('edit') }}</button>
                        <button class="action-btn delete">{{ ucfirst('delete') }}</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="custom-pagination">
        {{ $products->links() }}
    </div>
    </div>
</div>
</body>

<script>
    document.getElementById('sidebar-toggle').onclick = function() {
    document.body.classList.toggle('sidebar-closed');
    document.body.classList.toggle('sidebar-open');
};
</script>
@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const nameInput = document.getElementById('filter-name');
    const categoryInput = document.getElementById('filter-category');
    const priceMinInput = document.getElementById('filter-price-min');
    const priceMaxInput = document.getElementById('filter-price-max');
    const applyBtn = document.getElementById('filter-apply');
    const resetBtn = document.getElementById('filter-reset');
    const tbody = document.querySelector('.product-table tbody');

    let controller = null;
    
    function applyFilters() {
        const name = nameInput.value;
        const category = categoryInput.value;
        const priceMin = priceMinInput.value;
        const priceMax = priceMaxInput.value;

        if (controller) {
            controller.abort();
        }

        controller = new AbortController();
        const signal = controller.signal;

        const params = new URLSearchParams({
            name: name,
            category: category,
            price_min: priceMin,
            price_max: priceMax
        });

        fetch(`/products/filter?${params.toString()}`, { signal })
            .then(response => response.json())
            .then(data => {
                tbody.innerHTML = data.html;
            })
            .catch(error => {
                if (error.name !== 'AbortError') {
                    console.error('Error:', error);
                }
            });
    }

    nameInput.addEventListener('keyup', applyFilters);
    applyBtn.addEventListener('click', applyFilters);
    resetBtn.addEventListener('click', function () {
        nameInput.value = '';
        categoryInput.value = '';
        priceMinInput.value = '';
        priceMaxInput.value = '';
        applyFilters();
    });
});
</script>
@endpush

@endsection
