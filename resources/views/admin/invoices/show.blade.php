<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAX INVOICE - ORIZAA STYLE</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&amp;display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f8f8f8;
            padding: 20px;
            line-height: 1.3;
        }

        .invoice-container {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            border: 2px solid #2c2c2c;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: visible;
            position: relative;
        }

        /* Header Bar */
        .header-bar {
            background-color: #8B5A2B;
            color: white;
            display: flex;
            align-items: center;
            padding: 12px 25px;
            height: 110px;
        }





        .address {
            flex: 1;
            text-align: right;
            font-size: 13px;
            line-height: 1.4;
        }

        .address .title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        /* Title */
        .invoice-title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 3px;
            color: #2c2c2c;
            padding: 8px 0;
            border-bottom: 4px solid #8B5A2B;
            background: linear-gradient(to right, #f5f0e8, #fff);
        }

        /* Top Info Section */
        .top-info {
            display: flex;
            padding: 15px 25px;
            gap: 20px;
        }

        .left-info {
            flex: 1;
        }

        .left-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .left-info td {
            padding: 6px 12px;
            font-size: 13px;
            border: 1px solid #2c2c2c;
        }

        .right-info {
            flex: 1.4;
        }

        .right-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .right-info td {
            padding: 6px 12px;
            font-size: 13px;
            border: 1px solid #2c2c2c;
        }

        .label {
            font-weight: bold;
            background: #f5f0e8;
            width: 38%;
        }

        /* Sold To Section */
        .sold-to {
            padding: 0 25px 15px;
        }

        .sold-to-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        .sold-to-table td {
            padding: 8px 12px;
            font-size: 13px;
            border: 1px solid #2c2c2c;
            vertical-align: top;
        }

        .sold-to-table .section-header {
            background: #8B5A2B;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        /* Items Table */
        .items-table {
            margin: 0 25px 15px;
            width: calc(100% - 50px);
            border-collapse: collapse;
        }

        .items-table th {
            background: #8B5A2B;
            color: white;
            font-weight: bold;
            font-size: 13px;
            padding: 10px 8px;
            border: 1px solid #2c2c2c;
            text-align: center;
        }

        .items-table td {
            padding: 8px 8px;
            font-size: 13px;
            border: 1px solid #2c2c2c;
            text-align: center;
            height: 25px;
        }

        .items-table td.price-col {
            background: #f5f0e8;
        }

        .items-table td.left-align {
            text-align: left;
        }

        /* Totals Section */
        .totals {
            margin: 0 25px 20px;
            width: calc(100% - 50px);
        }

        .totals table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals td {
            padding: 8px 15px;
            font-size: 14px;
            border: 1px solid #2c2c2c;
        }

        .totals .label {
            font-weight: bold;
            background: #f5f0e8;
            text-align: right;
        }

        .totals .amount {
            font-weight: bold;
            width: 40%;
        }

        /* Bottom Section */
        .bottom-section {
            display: flex;
            padding: 0 25px;
            gap: 25px;
            margin-bottom: 15px;
        }

        .bank-details {
            flex: 1;
        }

        .bank-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bank-table td {
            padding: 6px 12px;
            font-size: 13px;
            border: 1px solid #2c2c2c;
        }

        .bank-table .label {
            font-weight: bold;
            background: #f5f0e8;
            width: 38%;
        }

        .right-bottom {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .cheque-text {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            line-height: 1.4;
        }

        /* Thank You Stamp */
        .stamp {
            width: 140px;
            height: 140px;
            margin: 0 auto;
            background: #8B5A2B;
            border: 8px solid #E8C080;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 19px;
            font-weight: 700;
            text-align: center;
            line-height: 1.1;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            transform: rotate(-8deg);
            position: relative;
        }

        .stamp::before {
            content: '';
            position: absolute;
            top: -12px;
            left: -12px;
            right: -12px;
            bottom: -12px;
            border: 4px solid #E8C080;
            border-radius: 50%;
        }

        .stamp-text {
            font-size: 22px;
            letter-spacing: 1px;
        }

        .stamp-small {
            font-size: 11px;
            margin-top: 4px;
            letter-spacing: 3px;
        }

        /* Terms & Conditions */
        .terms {
            padding: 0 25px;
            font-size: 12.5px;
            line-height: 1.5;
        }

        .terms ol {
            padding-left: 20px;
        }

        .terms {
            margin-top: 15px;
            font-size: 13px;
            line-height: 1.5;
            overflow: visible;
        }

        .terms ol {
            padding-left: 18px;
            margin: 5px 0;
        }

        /* Footer */
        .footer {
            background-color: #8B5A2B;
            color: white;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            padding: 12px;
            letter-spacing: 4px;

            position: static;
            /* ✅ FIX */
            margin-top: 20px;
            /* ✅ spacing */
        }

        /* Print Optimization */
        @media print {
            body {
                padding: 0;
                background: white;
            }

            .invoice-container {
                width: 100%;
                min-height: auto;
                border: none;
                box-shadow: none;
                margin: 0;
            }

            .header-bar,
            .footer {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }

        /* Empty rows spacing */
        .empty-row td {
            height: 34px;
        }

        .top-info {
            display: flex;
            width: 100%;
            gap: 10px;
            /* optional spacing */
        }

        .left-info,
        .right-info {
            width: 50%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 14px;
        }

        .label {
            width: 40%;
            font-weight: 600;
        }

        /* SOLD TO Header */
        .section-header {
            background-color: #8B5E3C;
            /* brown */
            color: #fff;
            font-weight: bold;
            text-align: left;
        }

        .left-info table,
        .right-info table {
            height: 100%;
        }

        .left-info table tr,
        .right-info table tr {
            height: 25px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">

        <!-- HEADER BAR -->
        <div class="header-bar">
            <!-- Logo -->
            <img src="{{ asset('orizaa-logo.webp') }}" style="height:150px; width:auto; margin-top:50px;">

            <!-- Address -->
            <div class="address">
                <div class="title">B-28/5, Marhaba Apartment, Thokar Number 7</div>
                Shaheen Bagh, Opp Little Angel School<br>
                Okhla, New Delhi-110025<br>
                <a href="https://orizaastyle.com"
                    style="color:white; text-decoration:none; font-size:13px;">https://orizaastyle.com</a>
            </div>
        </div>

        <!-- INVOICE TITLE -->
        <div class="invoice-title">TAX INVOICE</div>

        <!-- TOP INFO SECTION -->
        <div class="top-info">

            <!-- LEFT: Date & Invoice No -->
            <div class="left-info">
                <table>
                    <tr>
                        <td class="label">Date</td>
                        <td>{{ \Carbon\Carbon::parse($invoice->date)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Invoice No</td>
                        <td>{{ $invoice->invoice_no }}</td>
                    </tr>
                    <tr>
                        <td class="section-header" colspan="2">SOLD TO:</td>
                    </tr>
                    <tr>
                        <td class="label">Customer Name</td>
                        <td>{{ $invoice->customer_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Address</td>
                        <td>{{ $invoice->address }}</td>
                    </tr>
                    <tr>
                        <td class="label">City, State, ZIP</td>
                        <td>{{ $invoice->city }}, {{ $invoice->state }} - {{ $invoice->zip }}</td>
                    </tr>
                    <tr>
                        <td class="label">GSTIN</td>
                        <td>{{ $invoice->gstin }}</td>
                    </tr>
                    <tr>
                        <td class="label">State Code</td>
                        <td><strong>{{ $invoice->state_code }}</strong></td>
                    </tr>

                </table>
            </div>

            <!-- RIGHT: Legal Info -->
            <div class="right-info">
                <table>
                    <tr>
                        <td class="label">Legal Name</td>
                        <td><strong>ORIZAA STYLE<br>THE ETHNIC SUITS HUB</strong></td>
                    </tr>
                    <tr>
                        <td class="label">GST NUMBER</td>
                        <td><strong>09ACQPF1162Q1Z2</strong></td>
                    </tr>
                    <tr>
                        <td class="label">PAN NUMBER</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="label">State</td>
                        <td><strong>DELHI</strong></td>
                    </tr>
                    <tr>
                        <td class="label">State Code</td>
                        <td><strong>07</strong></td>
                    </tr>
                    <tr>
                        <td class="label"></td>
                        <td><strong></strong></td>
                    </tr>
                    <tr>
                        <td class="label"></td>
                        <td><strong></strong></td>
                    </tr>
                    <tr>
                        <td class="label"></td>
                        <td><strong></strong></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- SOLD TO
        <div class="sold-to">
            <table class="sold-to-table">
                <tr>
                    <td class="section-header" colspan="2">SOLD TO:</td>
                </tr>
                <tr>
                    <td class="label">Customer Name</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="label">Address</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="label">City, State, ZIP</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="label">GSTIN</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="label">State Code</td>
                    <td><strong>07</strong></td>
                </tr>
            </table>
        </div>
        
        <!-- ITEMS TABLE -->
        <table class="items-table">
            <thead>
                <tr>
                    <th width="6%">SNO</th>
                    <th width="12%">ARTICLE NO</th>
                    <th width="38%">DESCRIPTION OF GOODS</th>
                    <th width="8%">QTY</th>
                    <th width="10%">RATE</th>
                    <th width="10%">DISCOUNT</th>
                    <th width="8%">GST</th>
                    <th width="8%" class="price-col">PRICE</th>
                </tr>
            </thead>
            <tbody>

                @foreach($invoice->items as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->article_no }}</td>
                        <td class="left-align">{{ $item->description }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->rate, 2) }}</td>
                        <td>
                            {{ $item->discount }}
                            {{ $item->discount_type == 'percent' ? '%' : '₹' }}
                        </td>
                        <td>{{ $item->gst }}%</td>
                        <td class="price-col">{{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach

                {{-- EMPTY ROWS TO KEEP DESIGN --}}
                @for($i = count($invoice->items); $i < 5; $i++)
                    <tr class="empty-row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor

            </tbody>
        </table>

        <!-- TOTALS -->
        <div class="totals">
            <table>
                <tr>
                    <td class="label">Total taxable Amount</td>
                    <td class="amount">{{ number_format($invoice->total_taxable, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Total Tax</td>
                    <td class="amount">{{ number_format($invoice->total_tax, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Amount in Words :</td>
                    <td>{{ $invoice->amount_in_words }}</td>
                </tr>
                <tr>
                    <td class="label" style="border-bottom: 2px solid #2c2c2c;">Total Amount</td>
                    <td class="amount" style="border-bottom: 2px solid #2c2c2c; font-size: 16px;">
                        {{ number_format($invoice->total_amount, 2) }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- BOTTOM SECTION -->
        <div class="bottom-section">

            <!-- Bank Details -->
            <div class="bank-details">
                <table class="bank-table">
                    <tr>
                        <td colspan="2"
                            style="background:#8B5A2B; color:white; font-weight:bold; text-align:center; padding:8px;">
                            Bank Details</td>
                    </tr>
                    <tr>
                        <td class="label">Bank Name</td>
                        <td><strong>IDFC FIRST</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Bank Account No.</td>
                        <td><strong>10232757847</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Bank Branch IFS Code</td>
                        <td><strong>IDFB002010</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Bank Branch</td>
                        <td><strong>Okhla Branch<br>New Delhi -110025</strong></td>
                    </tr>
                </table>
            </div>

            <!-- Right Bottom: Cheque + Stamp -->
            <div class="right-bottom">
                <div class="cheque-text">
                    Make All cheques in Favour of
                    <strong>ORIZAA STYLE THE ETHNIC SUITS HUB</strong>
                </div>

                <!-- Thank You Stamp -->
                <div class="stamp">
                    <div class="stamp-text">THANK YOU</div>
                    <div class="stamp-small">for YOUR<br>ORDER</div>
                </div>
            </div>
        </div>

        <!-- TERMS AND CONDITIONS -->
        <div class="terms">
            <strong>Terms and Conditions :</strong><br>
            <ol>
                <li>Payment Terms 50% Advance Payment and 50% on Delivery</li>
                <li>We do not object to this invoice 3 days, it will be presumed that you have accepted the invoice.
                </li>
                <li>Transportation charge will be paid by customer.</li>
            </ol>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            NO REFUND NO EXCHANGE
        </div>

    </div>

    <script>
        // Optional: Console message for user
        console.log('%c✅ 100% matching ORIZAA STYLE Tax Invoice HTML ready!', 'color:#8B5A2B; font-size:16px; font-weight:bold;');
    </script>
</body>

</html>