@extends('layouts.app')



@section('content')


<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f5f7fa;
}

.dashboard {
    display: flex;
    gap: 20px;
    padding: 20px;
}

/* SIDEBAR (WHITE CARD) */
.sidebar {
    width: 240px;
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.sidebar h2 {
    color: #c9a55c;
    margin-bottom: 15px;
    border-bottom:1px solid gray;
    font-size:22px;
    font-weight:600;
}

.sidebar a {
    display: block;
    padding: 10px;
    color: #333;
    text-decoration: none;
    border-radius: 6px;
    margin-bottom: 5px;
    cursor: pointer;
}

.sidebar a.active,
.sidebar a:hover {
    background: #c9a55c;
    color: #fff;
}

/* CONTENT */
.content {
    flex: 1;
}

.section { display: none; }
.section.active { display: block; }

/* CARD */
.card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

/* GRID */
.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

/* INPUT */
input, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
}

/* BUTTON */
.btn {
    background: linear-gradient(135deg, #c9a55c, #f4d03f);
    border: none;
    padding: 10px 15px;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
}

.btn-outline {
    border: 1px solid #c9a55c;
    padding: 8px 12px;
    background: transparent;
    color: #c9a55c;
    border-radius: 6px;
}

/* ORDER CARDS */
.order-card {
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 10px;
}

.order-top {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.badge {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
}

.delivered { background: #e6f7ee; color: #28a745; }
.pending { background: #fff3cd; color: #856404; }

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999; /* 🔥 increase */
}

.modal-content {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    width: 420px;
    max-width: 95%;
    z-index: 10000; /* 🔥 above everything */
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
}

.modal-content h3 {
    margin-bottom: 20px;
}

.modal-content input,
.modal-content textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px; /* 🔥 spacing fix */
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

.modal-content textarea {
    resize: none;
}

/* GRID spacing */
.modal-content .grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px; /* 🔥 better gap */
    margin-bottom: 10px;
}

/* BUTTON ALIGN */
.modal-actions {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 10px;
}


/* STAR */
.stars i {
    font-size:20px;
    cursor:pointer;
    color:#ccc;
}
.stars i.active {
    color:#f4d03f;
}

/* RESPONSIVE */
@media(max-width:768px){
    .dashboard {
        flex-direction: column;
    }
}
.profile-card h3 {
    font-size:22px;
    font-weight:600;
    margin-bottom: 20px;
    border-bottom:1px solid #f9f9f9;
}
.card h3{
   font-size:22px;
    font-weight:600;
    margin-bottom: 20px;
    border-bottom:1px solid #f9f9f9;  
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-size: 13px;
    margin-bottom: 5px;
    color: #555;
    font-weight: 500;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: 0.3s;
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
    gap: 15px;
}

.action-btns {
    margin-top: 15px;
    display: flex;
    gap: 10px;
}

/* MOBILE */
@media(max-width:768px){
    .grid-2 {
        grid-template-columns: 1fr;
    }
}

.order-products p {
    margin: 4px 0;
    font-size: 14px;
}

.order-price {
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
    font-size: 14px;
}

.discount {
    color: #28a745;
    font-weight: 500;
}



.invoice-card {
    /*max-width: 800px;*/
    margin: auto;
}

.invoice-header {
    text-align: center;
    margin-bottom: 20px;
}

.invoice-header img {
    height: 60px;
}

.invoice-top {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.text-right {
    text-align: right;
}

.invoice-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    font-size: 14px;
}

.invoice-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.invoice-table th, .invoice-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

.invoice-table th {
    background: #f4f4f4;
}

.invoice-summary {
    text-align: right;
}

.invoice-summary p {
    margin: 5px 0;
}

.invoice-summary .discount {
    color: #28a745;
}

.invoice-footer {
    margin-top: 20px;
    font-size: 12px;
    color: #777;
    border-top: 1px solid #eee;
    padding-top: 10px;
}

/* EMPTY STATE */
.wishlist-empty {
    border: 2px dashed #ddd;
    padding: 40px;
    text-align: center;
    border-radius: 10px;
    color: #888;
    margin-bottom: 20px;
}

/* GRID */
.wishlist-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

/* ITEM CARD */
.wishlist-item {
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    transition: 0.3s;
}

.wishlist-item:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.wishlist-item img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 10px;
}

.wishlist-item h4 {
    font-size: 14px;
    margin-bottom: 5px;
}

.price {
    color: #c9a55c;
    font-weight: 600;
    margin-bottom: 10px;
}
.address-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.address-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.address-card {
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 15px;
    position: relative;
    transition: 0.3s;
}

.address-card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.address-card.active {
    border: 2px solid #c9a55c;
}

.badge-default {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #c9a55c;
    color: #fff;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 20px;
}

.address-card h4 {
    margin-bottom: 5px;
}

.address-card p {
    font-size: 13px;
    margin: 3px 0;
}

.address-actions {
    margin-top: 10px;
    display: flex;
    gap: 8px;
}

/* MODAL SIZE */
.modal-content.large {
    width: 400px;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

/* LIST */
.review-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* CARD */
.review-card {
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 15px;
    transition: 0.3s;
}

.review-card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

/* TOP */
.review-top {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.review-date {
    font-size: 12px;
    color: #888;
}

/* STARS */
.review-stars {
    color: #f4d03f;
    margin-bottom: 8px;
    font-size: 14px;
}

/* TEXT */
.review-text {
    font-size: 14px;
    color: #555;
}


/* RESPONSIVE */
@media(max-width:768px){
    .address-grid {
        grid-template-columns: 1fr;
    }
}


/* RESPONSIVE */
@media(max-width:768px){
    .wishlist-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media(max-width:480px){
    .wishlist-grid {
        grid-template-columns: 1fr;
    }
}

.order-meta {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: #666;
    margin: 8px 0;
}

.order-date {
    font-size: 12px;
    color: #888;
}

/* PRICE BOX */
.order-price-box {
    margin-top: 10px;
    border-top: 1px dashed #ddd;
    padding-top: 10px;
}

.price-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    margin-bottom: 5px;
}

.price-row.discount {
    color: #28a745;
}

.price-row.total {
    border-top: 1px solid #eee;
    margin-top: 8px;
    padding-top: 8px;
    font-size: 15px;
}

.od-wrapper {
    /*padding: 20px;*/
    /*background: #f5f7fa;*/
}

.od-card {
    /*max-width: 850px;*/
    margin: auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* HEADER */
.od-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.od-logo img {
    height: 60px;
}

.od-title h2 {
    margin: 0;
}

.od-title p {
    font-size: 13px;
    color: #666;
}

/* TOP */
.od-top {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    gap: 20px;
}

.od-box h4 {
    margin-bottom: 5px;
}

.od-box p {
    font-size: 13px;
    margin: 3px 0;
}

.od-right {
    text-align: right;
}

/* META */
.od-meta {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    font-size: 14px;
    margin-bottom: 20px;
}

/* TABLE */
.od-table {
    width: 100%;
    border-collapse: collapse;
}

.od-table th,
.od-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

.od-table th {
    background: #f4f4f4;
}

/* SUMMARY */
.od-summary {
    margin-top: 20px;
    text-align: right;
}

.od-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.od-discount {
    color: green;
}

.od-total {
    border-top: 1px solid #ddd;
    margin-top: 10px;
    padding-top: 10px;
    font-size: 16px;
}

/* FOOTER */
.od-footer {
    margin-top: 20px;
    font-size: 12px;
    color: #777;
    border-top: 1px solid #eee;
    padding-top: 10px;
}

/* BUTTON */
.od-action {
    text-align: center;
    margin-top: 20px;
}

.od-action button {
    background: linear-gradient(135deg, #c9a55c, #f4d03f);
    border: none;
    padding: 10px 18px;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
}

/* MOBILE */
@media(max-width:768px){
    .od-top {
        flex-direction: column;
    }

    .od-meta {
        flex-direction: column;
        gap: 5px;
    }

    .od-right {
        text-align: left;
    }
}


/* PRINT */
@media print {
    button {
        display: none;
    }
}

/* MOBILE VIEW */
@media(max-width:768px){

    .sidebar {
        display: flex;
        flex-direction: row;
        overflow-x: auto;
        gap: 10px;
        padding: 10px;
        width: 100%;
        white-space: nowrap;
        border-radius: 10px;
    }

    .sidebar h2 {
        display: none; /* hide title in mobile */
    }

    .sidebar a {
        flex: 0 0 auto;
        padding: 8px 14px;
        font-size: 14px;
        border-radius: 20px;
        background: #f1f1f1;
    }

    .sidebar a.active {
        background: #c9a55c;
        color: #fff;
    }

    /* Scrollbar hide (optional clean UI) */
    .sidebar::-webkit-scrollbar {
        display: none;
    }
}

</style>

<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>My Account</h2>
        <a onclick="showSection('profile')" class="active">Profile</a>
        <a onclick="showSection('orders')">Orders</a>
        <a onclick="showSection('wishlist')">Wishlist</a>
        <a onclick="showSection('address')">Address</a>
        <a onclick="showSection('reviews')">Reviews</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- PROFILE -->
<div id="profile" class="section active">
    <div class="card profile-card">

        <h3>Profile Details</h3>

        <form>

            <!-- NAME -->
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" placeholder="Enter your full name">
            </div>

            <!-- EMAIL + MOBILE -->
            <div class="grid-2">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" placeholder="Enter mobile number">
                </div>
            </div>

            <!-- ALT MOBILE -->
            <div class="form-group">
                <label>Alternate Mobile Number</label>
                <input type="text" placeholder="Enter alternate number">
            </div>

            <!-- ADDRESS -->
            <div class="form-group">
                <label>Address</label>
                <textarea rows="3" placeholder="Enter full address"></textarea>
            </div>

            <!-- CITY + PIN -->
            <div class="grid-2">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" placeholder="City">
                </div>

                <div class="form-group">
                    <label>Pincode</label>
                    <input type="text" placeholder="Pincode">
                </div>
            </div>

            <!-- STATE -->
            <div class="form-group">
                <label>State</label>
                <input type="text" placeholder="State">
            </div>

            <!-- BUTTON -->
            <button class="btn">Update Profile</button>

            <!-- CHANGE BUTTONS -->
            <div class="action-btns">
                <button type="button" class="btn-outline">Change Mobile</button>
                <button type="button" class="btn-outline">Change Email</button>
            </div>

        </form>

    </div>
</div>


        <!-- ORDERS -->
    <div id="orders" class="section order-card">

    <!-- TOP -->
    <div class="order-top">
        <div>
            <strong>#ORD123</strong>
            <p class="order-date">12 Apr 2026</p>
        </div>
        <span class="badge delivered">Delivered</span>
    </div>

    <!-- ORDER META -->
    <div class="order-meta">
        <p><strong>Invoice No:</strong> INV-2026-00123</p>
        <p><strong>Payment:</strong> Paid (Online)</p>
    </div>

    <!-- PRODUCTS -->
    <div class="order-products">
        <p>🎁 Gift Box x1</p>
        <p>🎁 Premium Hamper x1</p>
    </div>

    <!-- PRICE BREAKDOWN -->
    <div class="order-price-box">
        <div class="price-row">
            <span>Subtotal</span>
            <span>₹1500</span>
        </div>

        <div class="price-row discount">
            <span>Discount (Coupon)</span>
            <span>-₹100</span>
        </div>

        <div class="price-row">
            <span>Shipping</span>
            <span>₹50</span>
        </div>

        <div class="price-row">
            <span>GST (18%)</span>
            <span>₹252</span>
        </div>

        <div class="price-row total">
            <strong>Total</strong>
            <strong>₹1702</strong>
        </div>
    </div>

    <!-- ACTION -->
    <button class="btn" onclick="showSection('orderDetail')">View Details</button>

</div>



        <!-- ORDER DETAIL -->
<div id="orderDetail" class="section">
<div class="od-wrapper">
    <div class="od-card">

        <!-- HEADER -->
        <div class="od-header">
            <div class="od-logo">
                <img src="{{ asset('images/oriza-logo1.jpeg') }}" alt="Logo">
            </div>

            <div class="od-title">
                <h2>Order Details</h2>
                <p><strong>Invoice No:</strong> INV-2026-00123</p>
            </div>
        </div>

        <!-- TOP -->
        <div class="od-top">

            <!-- BILL -->
            <div class="od-box">
                <h4>Bill To</h4>
                <p>Janmejay Kumar</p>
                <p>Noida, Uttar Pradesh</p>
                <p>+91 8887987465</p>
                <p>janmejayk0007@gmail.com</p>
            </div>

            <!-- COMPANY -->
            <div class="od-box od-right">
                <h4>B2B Gifts India</h4>
                <p>510A, iThum Tower – B</p>
                <p>Sector 62, Noida</p>
                <p>GSTIN: 09ABCDE1234F1Z5</p>
                <p>service@b2bgiftsindia.com</p>
            </div>

        </div>

        <!-- ORDER META -->
        <div class="od-meta">
            <p><strong>Order ID:</strong> #ORD123</p>
            <p><strong>Date:</strong> 12 Apr 2026</p>
            <p><strong>Status:</strong> Delivered</p>
            <p><strong>Payment:</strong> Paid (Online)</p>
        </div>

        <!-- TABLE -->
        <div class="od-table-wrap">
            <table class="od-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Gift Box</td>
                        <td>1</td>
                        <td>₹500</td>
                        <td>₹500</td>
                    </tr>
                    <tr>
                        <td>Premium Hamper</td>
                        <td>1</td>
                        <td>₹1000</td>
                        <td>₹1000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- SUMMARY -->
        <div class="od-summary">
            <div class="od-row">
                <span>Subtotal</span>
                <span>₹1500</span>
            </div>

            <div class="od-row od-discount">
                <span>Discount</span>
                <span>-₹100</span>
            </div>

            <div class="od-row">
                <span>Shipping</span>
                <span>₹50</span>
            </div>

            <div class="od-row">
                <span>GST (18%)</span>
                <span>₹252</span>
            </div>

            <div class="od-row od-total">
                <strong>Total</strong>
                <strong>₹1702</strong>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="od-footer">
            <p>
                This is a system-generated order invoice. All disputes are subject to jurisdiction. 
                Products once delivered will not be returned unless defective.
            </p>
        </div>

        <!-- ACTION -->
        <div class="od-action">
            <button onclick="window.print()">Download Invoice</button>
        </div>

    </div>
</div>

</div>


        <!-- WISHLIST -->
        <div id="wishlist" class="section">
    <div class="card">
        <h3>My Wishlist</h3>

        <!-- EMPTY STATE -->
        <div class="wishlist-empty">
            <p>No items added in wishlist</p>
        </div>

        <!-- PRODUCTS (SHOW WHEN DATA AVAILABLE) -->
        <div class="wishlist-grid">

            <div class="wishlist-item">
                <img src="https://via.placeholder.com/150" alt="Product">
                <h4>Luxury Gift Hamper</h4>
                <p class="price">₹999</p>
                <button class="btn">Add to Cart</button>
            </div>

            <div class="wishlist-item">
                <img src="https://via.placeholder.com/150" alt="Product">
                <h4>Corporate Gift Box</h4>
                <p class="price">₹799</p>
                <button class="btn">Add to Cart</button>
            </div>

        </div>

    </div>
</div>


        <!-- ADDRESS -->
        <div id="address" class="section">
    <div class="card">
        <div class="address-header">
            <h3>Address Book</h3>
            <button class="btn" onclick="openAddressModal()">+ Add Address</button>
        </div>

        <div class="address-grid">

            <!-- ACTIVE ADDRESS -->
            <div class="address-card active">
                <span class="badge-default">Default</span>
                <h4>Home</h4>
                <p>Janmejay Kumar</p>
                <p>Noida, Sector 62, Uttar Pradesh - 201301</p>
                <p>+91 8887987465</p>

                <div class="address-actions">
                    <button class="btn-outline">Edit</button>
                    <button class="btn-outline">Remove</button>
                </div>
            </div>

            <!-- ADDRESS 2 -->
            <div class="address-card">
                <h4>Office</h4>
                <p>Janmejay Kumar</p>
                <p>Delhi, Connaught Place - 110001</p>
                <p>+91 8887987465</p>

                <div class="address-actions">
                    <button class="btn-outline">Set Default</button>
                    <button class="btn-outline">Remove</button>
                </div>
            </div>

            <!-- ADDRESS 3 -->
            <div class="address-card">
                <h4>Warehouse</h4>
                <p>Janmejay Kumar</p>
                <p>Ghaziabad, UP - 201010</p>
                <p>+91 8887987465</p>

                <div class="address-actions">
                    <button class="btn-outline">Set Default</button>
                    <button class="btn-outline">Remove</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="addressModal">
    <div class="modal-content large">

        <h3>Add New Address</h3>

        <div class="grid-2">
            <input placeholder="Full Name">
            <input placeholder="Mobile Number">
        </div>

        <textarea placeholder="Full Address" rows="3"></textarea>

        <div class="grid-2">
            <input placeholder="City">
            <input placeholder="Pincode">
        </div>

        <input placeholder="State">

        <br><br>
        <div class="modal-actions">
    <button class="btn">Save Address</button>
    <button onclick="closeAddressModal()">Cancel</button>
</div>


    </div>
</div>


        <!-- REVIEWS -->
        <div id="reviews" class="section">
    <div class="card">
        
        <div class="review-header">
            <h3>Feedback & Reviews</h3>
            <button class="btn" onclick="openModal()">Give Review</button>
        </div>

        <!-- REVIEW LIST -->
        <div class="review-list">

            <!-- REVIEW 1 -->
            <div class="review-card">
                <div class="review-top">
                    <strong>Rahul Sharma</strong>
                    <span class="review-date">12 Apr 2026</span>
                </div>

                <div class="review-stars">
                    ★★★★★
                </div>

                <p class="review-text">
                    Amazing quality products! Packaging was premium and delivery was on time.
                </p>
            </div>

            <!-- REVIEW 2 -->
            <div class="review-card">
                <div class="review-top">
                    <strong>Priya Verma</strong>
                    <span class="review-date">10 Apr 2026</span>
                </div>

                <div class="review-stars">
                    ★★★★☆
                </div>

                <p class="review-text">
                    Good experience overall. Product quality is nice but delivery was slightly delayed.
                </p>
            </div>

            <!-- REVIEW 3 -->
            <div class="review-card">
                <div class="review-top">
                    <strong>Amit Singh</strong>
                    <span class="review-date">05 Apr 2026</span>
                </div>

                <div class="review-stars">
                    ★★★★★
                </div>

                <p class="review-text">
                    Highly recommended for corporate gifting. Great customization options!
                </p>
            </div>

        </div>

    </div>
</div>


    </div>
</div>

<!-- MODAL -->
<div class="modal" id="reviewModal">
    <div class="modal-content">
        <h4>Rate Your Experience</h4>

        <div class="stars">
            <i onclick="rate(1)">★</i>
            <i onclick="rate(2)">★</i>
            <i onclick="rate(3)">★</i>
            <i onclick="rate(4)">★</i>
            <i onclick="rate(5)">★</i>
        </div>

        <textarea placeholder="Write review..." style="margin-top:10px;"></textarea>

        <br><br>
        <button class="btn">Submit</button>
        <button onclick="closeModal()">Close</button>
    </div>
</div>

<script>
function showSection(id) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.getElementById(id).classList.add('active');

    document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
    event.target.classList.add('active');
}

function openModal() {
    document.getElementById('reviewModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('reviewModal').style.display = 'none';
}

function rate(num) {
    let stars = document.querySelectorAll('.stars i');
    stars.forEach((s, i) => {
        s.classList.toggle('active', i < num);
    });
}
function openAddressModal() {
    document.getElementById('addressModal').style.display = 'flex';
}

function closeAddressModal() {
    document.getElementById('addressModal').style.display = 'none';
}

</script>


@endsection