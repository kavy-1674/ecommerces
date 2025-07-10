@extends('admin.layouts.app')

@section('content')
<style>
    .product-table-container {
        background: #f3f4f6;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        padding: 2rem;
        margin: 2rem auto;
        max-width: 1200px;
    }
    .product-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(220,38,38,0.04);
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
    .product-checkbox {
        accent-color: #dc2626;
        width: 1.1rem;
        height: 1.1rem;
        cursor: pointer;
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
        background: none;
    }
    .action-btn.edit:hover {
        background: #d1fae5;
    }
    .action-btn.delete {
        color: #dc2626;
        background: none;
    }
    .action-btn.delete:hover {
        background: #fee2e2;
    }
    .table-header-checkbox {
        accent-color: #dc2626;
        width: 1.1rem;
        height: 1.1rem;
        cursor: pointer;
    }
    @media (max-width: 900px) {
        .product-table-container { padding: 0.5rem; }
        .product-table th, .product-table td { padding: 0.5rem; }
    }
</style>

<div class="product-table-container">
    <h2 style="color:#dc2626; font-size:1.5rem; font-weight:700; margin-bottom:1.5rem;">Product Management</h2>
    <table class="product-table">
        <thead>
            <tr>
                <th><input type="checkbox" class="table-header-checkbox" id="select-all"></th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Sale Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox" class="product-checkbox"></td>
                <td><img src="https://via.placeholder.com/48x48.png?text=TV" class="product-image" alt="Product"></td>
                <td>Smart LED TV</td>
                <td>32-inch HD Ready, Smart features, 2 HDMI ports</td>
                <td>₹12,999</td>
                <td>
                    <button class="action-btn edit">Edit</button>
                    <button class="action-btn delete">Delete</button>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class="product-checkbox"></td>
                <td><img src="https://via.placeholder.com/48x48.png?text=SH" class="product-image" alt="Product"></td>
                <td>Running Shoes</td>
                <td>Lightweight, Breathable, Size 7-11</td>
                <td>₹2,499</td>
                <td>
                    <button class="action-btn edit">Edit</button>
                    <button class="action-btn delete">Delete</button>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class="product-checkbox"></td>
                <td><img src="https://via.placeholder.com/48x48.png?text=BK" class="product-image" alt="Product"></td>
                <td>Novel Book</td>
                <td>Bestselling fiction, 350 pages, Paperback</td>
                <td>₹399</td>
                <td>
                    <button class="action-btn edit">Edit</button>
                    <button class="action-btn delete">Delete</button>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class="product-checkbox"></td>
                <td><img src="https://via.placeholder.com/48x48.png?text=BL" class="product-image" alt="Product"></td>
                <td>Bluetooth Speaker</td>
                <td>Portable, 10hr battery, Water-resistant</td>
                <td>₹1,299</td>
                <td>
                    <button class="action-btn edit">Edit</button>
                    <button class="action-btn delete">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script>
// Select all checkbox functionality
const selectAll = document.getElementById('select-all');
const checkboxes = document.querySelectorAll('.product-checkbox');
selectAll.addEventListener('change', function() {
    checkboxes.forEach(cb => cb.checked = selectAll.checked);
});
</script>
@endsection 