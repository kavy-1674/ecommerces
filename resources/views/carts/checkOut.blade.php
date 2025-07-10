@extends('layouts.app')

@section('content')
<style>
    .checkout-container {
    max-width: 900px;
    margin: 2.5rem auto;
    background: #f9fafb;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
    padding: 2.5rem 2rem;
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
}
.checkout-container h2 {
    color: #dc2626;
    text-align: center;
    margin-bottom: 1.5rem;
    font-size: 2.1rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}
.order-summary, .shipping-form, .payment-section {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(220,38,38,0.04);
    padding: 1.5rem 1.2rem 1.2rem 1.2rem;
    margin-bottom: 0.5rem;
}
.order-summary h3, .shipping-form h3, .payment-section h3 {
    color: #dc2626;
    margin-bottom: 1rem;
    font-size: 1.25rem;
    font-weight: 600;
}
.order-summary ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.order-summary li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.6rem 0;
    border-bottom: 1px solid #f3f4f6;
    font-size: 1.05rem;
}
.order-summary li:last-child {
    border-bottom: none;
}
.order-summary .total-row {
    font-weight: 700;
    color: #dc2626;
    font-size: 1.1rem;
    background: #fef2f2;
    border-radius: 8px;
    padding: 0.7rem 0.5rem;
    margin-top: 1rem;
}
.shipping-form form {
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
}
.shipping-form input,
.shipping-form textarea {
    padding: 0.8rem 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    background: #f3f4f6;
    transition: border 0.2s;
}
.shipping-form input:focus,
.shipping-form textarea:focus {
    border: 1.5px solid #dc2626;
    outline: none;
    background: #fff;
}
.shipping-form textarea {
    min-height: 80px;
    resize: vertical;
}
.payment-section {
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
}
.place-order-btn {
    background: linear-gradient(90deg, #dc2626 0%, #f87171 100%);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 1rem 2.5rem;
    font-size: 1.25rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 16px rgba(220,38,38,0.10);
    transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
    letter-spacing: 0.5px;
    outline: none;
    margin: 2rem auto 0 auto;
    display: block;
    animation: popIn 0.5s cubic-bezier(.68,-0.55,.27,1.55);
}
.place-order-btn:hover, .place-order-btn:focus {
    background: linear-gradient(90deg, #b91c1c 0%, #f87171 100%);
    box-shadow: 0 8px 24px rgba(220,38,38,0.18);
    transform: translateY(-2px) scale(1.03);
}
.place-order-btn:active {
    background: #b91c1c;
    transform: scale(0.98);
}
@keyframes popIn {
    0% { opacity: 0; transform: scale(0.8);}
    100% { opacity: 1; transform: scale(1);}
}
@media (max-width: 700px) {
    .checkout-container {
        padding: 1rem 0.3rem;
        gap: 1.2rem;
    }
    .order-summary, .shipping-form, .payment-section {
        padding: 1rem 0.5rem 0.7rem 0.5rem;
    }
    .place-order-btn {
        padding: 0.8rem 1.2rem;
        font-size: 1.05rem;
    }
}

</style>
<div class="checkout-container">
    <h2>Checkout</h2>
    
    <!-- Order Summary -->
    <div class="order-summary">
        <h3>Order Summary</h3>
        <!-- Cart items here -->
    </div>
    
    <!-- Shipping Form -->
    <div class="shipping-form">
        <h3>Shipping Information</h3>
        <form>
            <input type="text" placeholder="Full Name">
            <input type="email" placeholder="Email">
            <textarea placeholder="Address"></textarea>
            <!-- More fields -->
        </form>
    </div>
    
    <!-- Payment Section -->
    <div class="payment-section">
        <h3>Payment Method</h3>
        <!-- Payment options -->
    </div>
    
    <!-- Place Order Button -->
    <button class="place-order-btn">Place Order</button>
</div>
@endsection