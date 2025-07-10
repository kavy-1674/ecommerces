@extends('layouts.app')

@section('content')
<style>
    .cart-container {
        background: #f3f4f6;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        padding: 2rem;
        margin: 2rem auto;
        max-width: 900px;
        width: 100%;
    }
    .cart-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(220,38,38,0.04);
    }
    .cart-table th, .cart-table td {
        padding: 1rem 1.25rem;
        text-align: left;
        color: #374151;
    }
    .cart-table th {
        background: #fef2f2;
        color: #dc2626;
        font-weight: 600;
        border-bottom: 2px solid #f3f4f6;
    }
    .cart-table tbody tr {
        transition: background 0.2s;
    }
    .cart-table tbody tr:hover {
        background: #f3f4f6;
    }
    .cart-table td {
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    .cart-image {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #f3f4f6;
        background: #fef2f2;
    }
    .qty-btn {
        background: #fef2f2;
        color: #dc2626;
        border: none;
        border-radius: 6px;
        padding: 0.3rem 0.7rem;
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0 0.2rem;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }
    .qty-btn:hover {
        background: #fee2e2;
    }
    .remove-btn {
        color: #fff;
        background: #dc2626;
        border: none;
        border-radius: 6px;
        padding: 0.4rem 0.9rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .remove-btn:hover {
        background: #b91c1c;
    }
    .cart-total-row td {
        font-weight: 700;
        color: #dc2626;
        background: #fef2f2;
        border-bottom: none;
    }
    .cart-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 1.5rem;
    }

    .proceed-btn {
        background: #dc2626;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.9rem 2.2rem;
        font-size: 1.2rem;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(220,38,38,0.08);
        transition: background 0.2s, box-shadow 0.2s;
    }

    .proceed-btn:hover {
        background: #b91c1c;
        box-shadow: 0 4px 16px rgba(220,38,38,0.15);
    }
    @media (max-width: 700px) {
        .cart-table th, .cart-table td { padding: 0.5rem; }
        .cart-container { padding: 0.5rem; }
    }
</style>

<div class="cart-container">
    <h2 style="color: #dc2626; text-align: center; margin-bottom: 2rem;">Your Cart</h2>
    <div class="cart-actions">
        <a href="{{ route('checkout') }}" class="proceed-btn">Proceed to Buy</a>
    </div>
    <table class="cart-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>  
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody id="cart-body">
            <!-- JS will render rows here -->
        </tbody>
        <tfoot>
            <tr class="cart-total-row">
                <td colspan="4" style="text-align: right;">Grand Total</td>
                <td id="grand-total">₹0</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

</div>
<script>
    const cartData = @json(session('cart', []));
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartBody = document.getElementById('cart-body');
    const grandTotalElement = document.getElementById('grand-total');
    
    let grandTotal = 0;

    Object.entries(cartData).forEach(([productId, product]) => {
        const row = document.createElement('tr');

        const total = parseFloat(product.price) * product.quantity;
        
        grandTotal += total;
        
        row.innerHTML = `
            <td><img src="storage/${product.image}" class="cart-image" alt="${product.name}"></td>
            <td>${product.name}</td>
            <td>₹${parseFloat(product.price).toLocaleString()}</td>
            <td>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button class="decrease-btn bg-gray-300 px-2 py-1 rounded" data-id="${productId}">-</button>
                    <span class="quantity-text">${product.quantity}</span>
                    <button class="increase-btn bg-gray-300 px-2 py-1 rounded" data-id="${productId}">+</button>
                </div>
            </td>
            <td>₹${total.toLocaleString()}</td>
            <td><button class="remove-btn" data-id="${productId}">Remove</button></td>
        `;

        cartBody.appendChild(row);
    });

    // Move this listener OUTSIDE the forEach
// 🔒 LOCKED: Event Listener for Cart Quantity Update
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('increase-btn') || e.target.classList.contains('decrease-btn')) {
        const productId = e.target.getAttribute('data-id');
        const action = e.target.classList.contains('increase-btn') ? 'increase' : 'decrease';

        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        fetch('/cart/update-quantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ id: productId, action: action })
        })
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(data => {
            if (data.success) {
                const row = document.querySelector(`button[data-id="${productId}"]`).closest('tr');
                row.querySelector('.quantity-text').textContent = data.quantity;

                // Agar data.total undefined hai toh 0 use karo
                const rowTotal = typeof data.total === 'number' ? data.total : 0;
                row.querySelector('td:nth-child(5)').innerText = `₹${rowTotal.toLocaleString()}`;

                // Agar data.grand_total undefined hai toh 0 use karo
                const grandTotal = typeof data.grand_total === 'number' ? data.grand_total : 0;
                document.getElementById('grand-total').innerText = `₹${grandTotal.toLocaleString()}`;
            }
        })
        .catch(err => {
            console.error('Fetch error:', err);
        });
    }
});
    grandTotalElement.innerText = `₹${grandTotal.toLocaleString()}`;
});
</script>

    
@endsection
