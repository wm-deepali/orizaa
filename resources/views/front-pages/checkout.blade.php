@extends('layouts.app')



@section('content')


<style>
    body {
        margin: 0;
        padding: 0;
        background: #f5f7fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .checkout-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    h2 {
        margin-bottom: 20px;
        font-size: 22px;
        border-left: 4px solid #c9a55c;
        padding-left: 10px;
    }

    /* FORM */
    .form-group {
        margin-bottom: 15px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #c9a55c;
        outline: none;
        box-shadow: 0 0 0 2px rgba(201,165,92,0.2);
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    /* ORDER SUMMARY */
    .order-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .order-total {
        font-weight: bold;
        font-size: 16px;
        margin-top: 15px;
        border-top: 1px solid #eee;
        padding-top: 10px;
    }

    /* BUTTON */
    .checkout-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #c9a55c, #f4d03f);
        border: none;
        color: #fff;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 15px;
    }

    .checkout-btn:hover {
        opacity: 0.9;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .checkout-container {
            grid-template-columns: 1fr;
        }

        .grid-2 {
            grid-template-columns: 1fr;
        }
    }
    .coupon-box {
    display: flex;
    gap: 10px;
    margin: 15px 0;
}

.coupon-box input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
}

.apply-btn {
    padding: 10px 15px;
    background: #c9a55c;
    border: none;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
}

.apply-btn:hover {
    opacity: 0.9;
}

.text-success {
    color: #28a745;
    font-weight: 500;
}

.terms-box {
    margin-top: 12px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.terms-box a {
    color: #c9a55c;
    text-decoration: none;
}

</style>

<div class="checkout-container">

    <!-- LEFT: BILLING DETAILS -->
    <div class="card">
        <h2>Billing Details</h2>

        <form method="POST" action="#">
            @csrf

            <div class="grid-2">
                <div class="form-group">
                    <input type="text" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <div class="form-group">
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>

            <div class="form-group">
                <textarea name="address" placeholder="Full Address" rows="3" required></textarea>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <input type="text" name="city" placeholder="City" required>
                </div>
                <div class="form-group">
                    <input type="text" name="pincode" placeholder="Pincode" required>
                </div>
            </div>

            <div class="form-group">
                <select name="state" required>
                    <option value="">Select State</option>
                    <option>Uttar Pradesh</option>
                    <option>Delhi</option>
                    <option>Maharashtra</option>
                </select>
            </div>

        </form>
    </div>

    <!-- RIGHT: ORDER SUMMARY -->
<div class="card">
    <h2>Your Order</h2>

    <!-- PRODUCTS -->
    <div class="order-item">
        <span>Product 1 x1</span>
        <span>₹500</span>
    </div>

    <div class="order-item">
        <span>Product 2 x2</span>
        <span>₹800</span>
    </div>

    <!-- COUPON -->
    <div class="coupon-box">
        <input type="text" placeholder="Enter Coupon Code">
        <button class="apply-btn">Apply</button>
    </div>

    <!-- PRICE BREAKDOWN -->
    <div class="order-item">
        <span>Subtotal</span>
        <span>₹1300</span>
    </div>

    <div class="order-item text-success">
        <span>Discount (Coupon)</span>
        <span>- ₹100</span>
    </div>

    <div class="order-item">
        <span>Shipping</span>
        <span>₹50</span>
    </div>

    <div class="order-item">
        <span>GST (18%)</span>
        <span>₹225</span>
    </div>

    <!-- TOTAL -->
    <div class="order-total">
        <div class="order-item">
            <span>Total Payable</span>
            <span>₹1475</span>
        </div>
    </div>

    <!-- PLACE ORDER -->
    <button class="checkout-btn">Place Order</button>

    <!-- TERMS -->
    <div class="terms-box">
        <input type="checkbox" id="terms">
        <label for="terms">
            I agree to the <a href="#">Terms & Conditions</a>
        </label>
    </div>
</div>


</div>


@endsection