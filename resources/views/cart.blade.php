@extends('admin.layouts.app')

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
    @media (max-width: 700px) {
        .cart-table th, .cart-table td { padding: 0.5rem; }
        .cart-container { padding: 0.5rem; }
    }
</style>

<div class="cart-container">
    <h2 style="color: #dc2626; text-align: center; margin-bottom: 2rem;">Your Cart</h2>
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
// Dummy cart data (used only if localStorage is empty)
const DUMMY_CART = [
    {id: 1, name: 'Smart LED TV', price: 12999, qty: 1, image: 'https://via.placeholder.com/48'},
    {id: 2, name: 'Running Shoes', price: 2499, qty: 2, image: 'https://via.placeholder.com/48/3b82f6/ffffff?text=SH'},
    {id: 3, name: 'Novel Book', price: 399, qty: 1, image: 'https://via.placeholder.com/48/f59e0b/ffffff?text=NB'},
];

function getCart() {
    const cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : DUMMY_CART;
}
function setCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}
function renderCart() {
    const cart = getCart();
    const tbody = document.getElementById('cart-body');
    let grandTotal = 0;
    tbody.innerHTML = '';
    cart.forEach((item, idx) => {
        const total = item.price * item.qty;
        grandTotal += total;
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><img src="${item.image}" class="cart-image" alt="Product"></td>
            <td>${item.name}</td>
            <td style="color:#10b981; font-weight:600;">₹${item.price.toLocaleString()}</td>
            <td>
                <button class="qty-btn" onclick="updateQty(${item.id}, -1)">-</button>
                <span id="qty-${item.id}">${item.qty}</span>
                <button class="qty-btn" onclick="updateQty(${item.id}, 1)">+</button>
            </td>
            <td style="font-weight:600;">₹${total.toLocaleString()}</td>
            <td><button class="remove-btn" onclick="removeItem(${item.id})">Remove</button></td>
        `;
        tbody.appendChild(tr);
    });
    document.getElementById('grand-total').textContent = '₹' + grandTotal.toLocaleString();
}
function updateQty(id, delta) {
    let cart = getCart();
    cart = cart.map(item => {
        if(item.id === id) {
            let newQty = item.qty + delta;
            if(newQty < 1) newQty = 1;
            return {...item, qty: newQty};
        }
        return item;
    });
    setCart(cart);
    renderCart();
}
function removeItem(id) {
    let cart = getCart();
    cart = cart.filter(item => item.id !== id);
    setCart(cart);
    renderCart();
}
// On first load, if no cart in localStorage, set dummy
if(!localStorage.getItem('cart')) setCart(DUMMY_CART);
renderCart();
</script>
@endsection 