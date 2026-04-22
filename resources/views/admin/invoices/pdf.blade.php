<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TAX INVOICE - ORIZAA STYLE</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.3;
            background: white;
        }

        .invoice-container {
            width: 100%;
            margin: 0 auto;
            background: white;
            border: 2px solid #2c2c2c;
        }

        /* ===== HEADER ===== */
        .header-bar {
            background-color: #8B5A2B;
            color: white;
            height: 100px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            height: 100px;
        }

        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .header-logo-cell {
            width: 140px;
            padding-left: 15px !important;
        }

        .header-address-cell {
            text-align: right;
            font-size: 11.5px;
            line-height: 1.5;
            padding-right: 20px !important;
            color: white;
        }

        .address-title {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        /* Logo circle — border-radius = exactly half width */
        .logo-outer {
            width: 96px;
            height: 96px;
            background: #8B5A2B;
            border: 5px solid #E8C080;
            border-radius: 48px;
            text-align: center;
            color: white;
            font-family: Georgia, serif;
            font-weight: bold;
        }

        .logo-inner { padding-top: 17px; }

        .logo-text {
            font-size: 17px;
            letter-spacing: 1px;
            line-height: 1.2;
        }

        .logo-sub {
            font-size: 6.5px;
            letter-spacing: 1.5px;
            margin-top: 2px;
        }

        /* ===== TITLE ===== */
        .invoice-title {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 3px;
            color: #2c2c2c;
            padding: 7px 0;
            border-bottom: 4px solid #8B5A2B;
            background: #f5f0e8;
        }

        /* ===== INNER TABLES ===== */
        .info-inner {
            width: 100%;
            border-collapse: collapse;
        }

        .info-inner td {
            padding: 5px 8px;
            font-size: 12px;
            border: 1px solid #2c2c2c;
            vertical-align: middle;
        }

        .label {
            font-weight: bold;
            background: #f5f0e8;
            width: 44%;
            white-space: nowrap;
        }

        .section-header {
            background-color: #8B5A2B;
            color: white;
            font-weight: bold;
            font-size: 12.5px;
            text-align: left;
        }

        /* ===== ITEMS TABLE ===== */
        .items-wrap { margin: 0 18px 10px; }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .items-table th {
            background: #8B5A2B;
            color: white;
            font-weight: bold;
            font-size: 11px;
            padding: 7px 3px;
            border: 1px solid #2c2c2c;
            text-align: center;
            white-space: nowrap;
        }

        .items-table td {
            padding: 6px 4px;
            font-size: 11.5px;
            border: 1px solid #2c2c2c;
            text-align: center;
            height: 24px;
        }

        .items-table td.price-col { background: #f5f0e8; }
        .items-table td.left-align { text-align: left; }
        .empty-row td { height: 45px; }

        /* ===== TOTALS ===== */
        .totals-wrap { margin: 0 18px 8px; }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 6px 12px;
            font-size: 12.5px;
            border: 1px solid #2c2c2c;
        }

        .totals-table .label {
            font-weight: bold;
            background: #f5f0e8;
            text-align: right;
            white-space: nowrap;
            width: 58%;
        }

        .totals-table .amount { font-weight: bold; }

        /* ===== BANK TABLE ===== */
        .bank-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bank-table td {
            padding: 5px 9px;
            font-size: 12px;
            border: 1px solid #2c2c2c;
            vertical-align: middle;
        }

        .bank-table .label {
            font-weight: bold;
            background: #f5f0e8;
            width: 42%;
            white-space: nowrap;
        }

        .bank-header-row td {
            background: #8B5A2B !important;
            color: white !important;
            font-weight: bold;
            text-align: center;
            padding: 7px !important;
            font-size: 12.5px;
        }

        .cheque-text {
            font-size: 12.5px;
            font-weight: bold;
            text-align: center;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        /* Stamp circle */
        .stamp {
            width: 90px;
            height: 90px;
            margin: 0 auto;
            background: #8B5A2B;
            border: 6px solid #E8C080;
            border-radius: 45px;
            text-align: center;
            color: white;
            font-family: Georgia, serif;
            font-weight: bold;
            padding-top: 18px;
        }

        .stamp-text { font-size: 14px; letter-spacing: 1px; }
        .stamp-small { font-size: 8px; margin-top: 3px; letter-spacing: 2px; }

        .terms {
            padding: 0 18px 6px;
            font-size: 11px;
            line-height: 1.4;
        }

        .terms ol { padding-left: 16px; margin: 2px 0; }

        /* ===== FOOTER ===== */
        .footer {
            background-color: #8B5A2B;
            color: white;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            padding: 9px;
            letter-spacing: 4px;
            margin-top: 6px;
        }
    </style>
</head>
<body>
<div class="invoice-container">

    <!-- HEADER -->
    <div class="header-bar">
        <table class="header-table">
            <tbody>
                <tr>
                    <td class="header-logo-cell">
                        <div class="logo-outer">
                            <div class="logo-inner">
                                <div class="logo-text">ORIZAA<br>STYLE</div>
                                <div class="logo-sub">THE ETHNIC SUITS HUB</div>
                            </div>
                        </div>
                    </td>
                    <td class="header-address-cell">
                        <div class="address-title">B-28/5, Marhaba Apartment, Thokar Number 7</div>
                        Shaheen Bagh, Opp Little Angel School<br>
                        Okhla, New Delhi-110025<br>
                        https://orizaastyle.com
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- TITLE -->
    <div class="invoice-title">TAX INVOICE</div>

    <!-- TOP INFO: two columns -->
    <table style="width:100%; border-collapse:collapse;">
        <tbody>
            <tr>
                <!-- LEFT -->
                <td style="width:50%; vertical-align:top; padding:7px 4px 7px 18px; border:none;">
                    <table class="info-inner">
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
                </td>

                <!-- RIGHT -->
                <td style="width:50%; vertical-align:top; padding:7px 18px 7px 4px; border:none;">
                    <table class="info-inner">
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
                            <td>&nbsp;</td>
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
                            <td style="border:1px solid #2c2c2c; height:22px;">&nbsp;</td>
                            <td style="border:1px solid #2c2c2c; height:22px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #2c2c2c; height:22px;">&nbsp;</td>
                            <td style="border:1px solid #2c2c2c; height:22px;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- ITEMS TABLE -->
    <div class="items-wrap">
        <table class="items-table">
            <thead>
                <tr>
                    <th width="5%">SNO</th>
                    <th width="11%">ARTICLE NO</th>
                    <th width="36%">DESCRIPTION OF GOODS</th>
                    <th width="8%">QTY</th>
                    <th width="10%">RATE</th>
                    <th width="11%">DISCOUNT</th>
                    <th width="8%">GST</th>
                    <th width="11%">PRICE</th>
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
                    <td>{{ $item->discount }}{{ $item->discount_type == 'percent' ? '%' : ' Rs.' }}</td>
                    <td>{{ $item->gst }}%</td>
                    <td class="price-col">{{ number_format($item->price, 2) }}</td>
                </tr>
                @endforeach

                @for($i = count($invoice->items); $i < 5; $i++)
                <tr class="empty-row">
                    <td></td><td></td><td></td><td></td>
                    <td></td><td></td><td></td><td></td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <!-- TOTALS -->
    <div class="totals-wrap">
        <table class="totals-table">
            <tr>
                <td class="label">Total Taxable Amount</td>
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
                <td class="label" style="border-bottom:2px solid #2c2c2c;">Total Amount</td>
                <td class="amount" style="border-bottom:2px solid #2c2c2c; font-size:14px;">
                    {{ number_format($invoice->total_amount, 2) }}
                </td>
            </tr>
        </table>
    </div>

    <!-- BOTTOM SECTION -->
    <table style="width:100%; border-collapse:collapse; margin-bottom:6px;">
        <tbody>
            <tr>
                <td style="width:50%; vertical-align:top; padding:0 8px 0 18px; border:none;">
                    <table class="bank-table">
                        <tr class="bank-header-row">
                            <td colspan="2">Bank Details</td>
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
                </td>
                <td style="width:50%; vertical-align:middle; text-align:center; padding:0 18px 0 8px; border:none;">
                    <div class="cheque-text">
                        Make All cheques in Favour of<br>
                        <strong>ORIZAA STYLE THE ETHNIC SUITS HUB</strong>
                    </div>
                    <div class="stamp">
                        <div class="stamp-text">THANK YOU</div>
                        <div class="stamp-small">for YOUR<br>ORDER</div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- TERMS -->
    <div class="terms">
        <strong>Terms and Conditions :</strong><br>
        <ol>
            <li>Payment Terms 50% Advance Payment and 50% on Delivery</li>
            <li>If you do not object to this invoice within 3 days, it will be presumed that you have accepted the invoice.</li>
            <li>Transportation charge will be paid by customer.</li>
        </ol>
    </div>

    <!-- FOOTER -->
    <div class="footer">NO REFUND NO EXCHANGE</div>

</div>
</body>
</html>