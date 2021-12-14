<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Print INVOICE {{ $master->{$master->getKeyName()} ?? '' }}</title>

    <style>
        body {
            margin: 10px;
        }

        table#border {
            border: 0.5px solid grey;
        }

        .print-only {
            display: none !important
        }

        * {
            background: transparent !important;
            color: black !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            text-shadow: none !important;
            -webkit-filter: none !important;
            filter: none !important;
            -ms-filter: none !important
        }

        *,
        *:before,
        *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        a,
        a:visited {
            text-decoration: underline
        }

        a[href]:after {
            content: "("attr(href) ")"
        }

        abbr[title]:after {
            content: "("attr(title) ")"
        }

        .ira:after,
        a[href^="javascript:"]:after,
        a[href^="#"]:after {
            content: ""
        }

        img {
            max-width: 100% !important;
            vertical-align: middle;
            max-height: 100% !important
        }

        table {
            border-collapse: collapse
        }

        th,
        td {
            border: solid 1px #333;
            padding: 0.25em 8px;
            vertical-align: top
        }

        dl {
            margin: 0
        }

        dd {
            margin: 0
        }

        @page {
            margin: 1.25cm 0.5cm
        }

        p,
        h2,
        h3 {
            orphans: 3;
            widows: 3
        }

        .hide-on-print {
            display: none !important
        }

        .print-only {
            display: block !important
        }

        .hide-for-print {
            display: none !important
        }

        .show-for-print {
            display: inherit !important
        }

        html {
            overflow-x: visible
        }

        body {
            font-size: 12px;
            line-height: 1.5;
            font-family: "sans-serif",
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: normal
        }

        h1 a,
        h2 a,
        h3 a,
        h4 a,
        h5 a,
        h6 a {
            font-weight: inherit
        }

        h2 {
            font-size: 2em;
            line-height: 1.5;
            margin-bottom: 0.75em
        }

        h3 {
            font-size: 1.5em;
            line-height: 1;
            margin-top: 2em;
            margin-bottom: 1em
        }

        h4 {
            font-size: 1.25em;
            line-height: 2.4
        }

        h5 {
            font-weight: bold;
            margin-top: 2.25em;
            margin-bottom: 0.75em
        }

        h6 {
            text-transform: uppercase;
            margin-top: 2.25em;
            margin-bottom: 0.75em
        }

        #page {
            width: 100%;
            position: relative
        }

        .bukalapak-transaction-slip {
            padding: 8px 9px;
            border: solid 1px #000;
            margin-bottom: 18px;
            width: 100%;
            position: relative
        }

        .bukalapak-transaction-slip--brand {
            height: 27px;
            display: block;
            float: left
        }

        .bukalapak-transaction-slip--heading {
            margin-top: 0;
            display: block;
            float: right;
            line-height: 1;
            font-size: 18px
        }

        .bukalapak-transaction-slip--courier {
            margin-top: -5px;
            display: block;
            float: right;
            font-size: 14px;
            position: relative;
            width: 100%;
            text-align: right
        }

        .bukalapak-transaction-slip-buyer {
            margin-top: 9px;
            margin-bottom: 9px;
            padding-right: 18px;
            clear: both;
            float: left;
            width: 62%;
            border-right: dotted 1px #000
        }

        .bukalapak-transaction-slip-buyer--heading {
            font-weight: bold;
            margin-top: 0
        }

        .bukalapak-transaction-slip-buyer--label {
            display: block;
            float: left;
            clear: both;
            width: 25%
        }

        .bukalapak-transaction-slip-buyer--label:after {
            content: ":"
        }

        .bukalapak-transaction-slip-buyer--name,
        .bukalapak-transaction-slip-buyer--phone {
            font-weight: bold
        }

        .bukalapak-transaction-slip-buyer--address {
            display: block;
            float: left;
            font-weight: bold;
            width: 75%;
            white-space: -moz-pre-wrap !important;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            white-space: pre-wrap;
            white-space: normal
        }

        .bukalapak-transaction-slip-seller {
            display: block;
            float: left;
            width: 38%;
            margin-top: 9px;
            margin-bottom: 9px;
            padding-left: 18px
        }

        .bukalapak-transaction-slip-seller--heading {
            font-weight: bold;
            margin-top: 0em
        }

        .bukalapak-transaction-slip-seller--lapak,
        .bukalapak-transaction-slip-seller--name {
            white-space: nowrap
        }

        .bukalapak-transaction-slip--footer {
            display: block;
            width: 100%;
            clear: both;
            margin-top: 18px;
            border-top: solid 1px #000;
            padding-top: 5px;
            font-size: 9px
        }

        .bukalapak-transaction-product {
            clear: both;
            position: relative;
            width: 100%
        }

        .bukalapak-transaction-product-item {
            width: 80%
        }

        .bukalapak-transaction-product-quantity {
            width: 20%
        }

        .address p {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        #description {
            line-height: 0.9px !important;
        }

        #logo {
            height: 70px;
            margin-top: 0px;
        }

        #box {
            position: absolute;
            right: 0;
            text-align: right;
            top: -30px;
        }

        #box h1 {
            margin-bottom: 0px;
            margin-right: -15px;
            font-size: 25px;
        }

        #box h2 {
            position: absolute;
            top: 70px;
            right: -3;
            text-align: right;
            font-size: 12px;
        }

        #box table {
            position: absolute;
            top: 60px;
            right: 0px;
            width: 280px;
            font-size: 10px;
        }

        #box table .head {
            width: 80px;
            text-align: right;
        }

        #address {
            margin-bottom: 20px;
            position: absolute;
            top: 60px;
            width: 50%;
            margin-left: 0px;
            line-height: 1.5;
        }

        #address h4 {
            font-size: 12px;
        }

        #address p {
            font-size: 10px;
            margin-bottom: 0px;
        }

        #container {
            margin-top: 40px;
        }

        #container table {
            width: 100% !important;
        }

        #container table .destination td {
            background-color: #F5F5F5 !important;
            text-align: left;
        }

        #container table .contact {
            text-align: left;
        }

        #container table .contact strong {
            font-size: 17px;
            text-transform: uppercase;
        }

        #container table .person {
            margin-top: 20px;
        }

        #container table .contact td {
            padding-top: 5px;
            padding-bottom: 10px;
        }

        #container table .contact td p {
            line-height: 1.5;
            margin-bottom: 0px;
            margin-top: 5px;
        }

        #container table .rest {
            text-align: left;
        }

        #container #headline {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding-bottom: 5px;
            margin: 0px;
        }

        #container table .message {
            margin-top: -15px !important;
            vertical-align: middle !important;
            padding-bottom: 20px !important;
        }

        #container table .message p {
            margin-bottom: -15px !important;
            line-height: 15px !important;
        }

        #container table .header td {
            padding-bottom: 7px;
            background-color: #F5F5F5 !important;
        }

        #container table .header .no {
            width: 25px;
        }

        #container table .header .product {
            width: 350px;
        }

        #container table .header .qty {
            width: 50px;
            text-align: right;
        }

        #container table .header .price {
            width: 100px;
            text-align: right;
        }

        #container table .header .total {
            width: 100px;
            text-align: right;
        }

        #container table .item td {
            vertical-align: middle !important;
        }


        #container table .item .no {
            text-align: center;
        }

        #container table .item .qty {
            text-align: right;
        }

        #container table .item .price {
            text-align: right;
        }

        #container table .item .total {
            text-align: right;
        }

        #container table .item .total span {
            position: relative;
            font-weight: bold;
            display: block;
            right: 0px;
            font-size: 10px;
            margin-left: 5px;
        }

        #container table .item .product h1 {
            font-size: 12px;
            margin: 0px;
        }

        #container table .item .product h2 {
            font-size: 10px;
            font-weight: bold;
            margin: 0px;
        }

        #container table .item .product h3 {
            font-size: 10px;
            text-align: left;
            font-weight: bold;
            margin: 0px;
            margin-top: 5px;
        }

        #container table .item .product p {
            font-size: 10px;
            text-align: left;
            margin: 0px;
        }

        #container table .item .product span {
            position: relative;
            font-weight: bold;
            display: block;
            right: 0px;
            font-size: 10px;
            margin-left: 5px;
            margin-top: 20px;
        }

        #container table .total_product td {
            text-align: right;
            background-color: #F5F5F5 !important;
            padding-bottom: 10px;
        }

        #container table .total_discount td {
            text-align: right;
            background-color: #F5F5F5 !important;
            padding-bottom: 10px;
        }

        #container table .total_tax td {
            text-align: right;
            background-color: #F5F5F5 !important;
            padding-bottom: 10px;
        }

        #container table .total_sumary td {
            text-align: right;
            background-color: lightgray !important;
            padding-bottom: 10px;
            font-weight: bold;
        }

        #paraf {
            margin-top: 10px;
            width: 100%;
            font-size: 10px;
            margin-bottom: -50px;
        }

        #paraf .header td {
            background-color: #F5F5F5 !important;
        }

        #paraf .content .sign {
            height: 130px;
            vertical-align: bottom !important;
            text-align: center;
        }


        #paraf .content .description {
            vertical-align: middle !important;
            text-align: left;
            line-height: 1px;
        }

        #paraf .header .sign {
            width: 150px;
            text-align: center;
        }

        #paraf .header .term {
            text-align: left;
        }

    </style>

</head>

<body>


<div id='page'>
        <img id="logo" src="{{ Helper::print('logo/logo.png') }}">
        <div id="box">
            <h1>
                <span>
                    NO. {{ str_replace('SO', 'INV', $master->{$master->getKeyName()}) ?? '' }}
                </span>
            </h1>

            <table>
                <tr>
                    <td class="head">
                        Tanggal Order
                    </td>
                    <td>
                        {{ $master->mask_created_at->format('d F Y') ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="head">
                        Order By
                    </td>
                    <td>
                        {{ $master->has_customer->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="head">
                        BL Number
                    </td>
                    <td>
                        {{ $master->has_job->jo_master_bl ?? '' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div id="address">
        <p>
            {{ env('WEBSITE_ADDRESS') ?? '' }}
        </p>
    </div>

    <div style="page-break-after: always;" id="container">
        <table cellpadding="" 5 cellspacing="0" width="100%">
            <tr>
                <td align='left' colspan='8' valign='middle'>
                    <h1 id="headline">
                        INVOICE
                    </h1>
                </td>
            </tr>
            <tr class="destination">
                <td colspan='8'>
                    <strong>Customer : </strong>
                </td>
            </tr>
            <tr class="contact">
                <td colspan='8'>
                    <strong>
                        {{ ucwords($master->has_customer->name) ?? '' }} {{ $master->so_company_name ? '('.$master->so_company_name.')' : '' }}
                    </strong>
                    <p>
                        {{ $master->has_customer->address ?? '' }}
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <p>
                        @php
                        $total_product = $total_value = 0;

                        $total_discount = $master->mask_discount;
                        $grand_total = intval($total_value - $total_discount);
                        $persentage = $grand_total * (env('DOWN_PAYMENT') / 100);
                        $down_payment = $grand_total - $persentage;
                        //$total_tax = $total_value * $master->so_tax_percent / 100;
                        //$grand_total = intval($total_value - $total_discount) + intval($total_tax);
                        @endphp

                    </p>

                    <p>
                        <i>{{ env('NOTES_TRACKING') }}</i>
                    </p>
                </td>
            </tr>

            <tr class="header">
                <td class="no">
                    <strong>No.</strong>
                </td>
                <td class="product" colspan="4">
                    <strong>Product Name</strong>
                </td>
                <td class="price">
                    <strong>Price</strong>
                </td>
                <td class="qty">
                    <strong>Qty</strong>
                </td>
                <td class="total">
                    <strong>Total</strong>
                </td>
            </tr>
            @foreach($detail as $item)

            @php
            $total_product = $item->mask_sent * $item->mask_price;
            $total_value = $total_value + $total_product;
            @endphp

            <tr class="item">
                <td class="no">
                    {{ $loop->iteration }}
                </td>
                <td class="product" colspan="4">
                    <h1>
                        {{ $item->has_product->product_name ?? '' }}
                    </h1>
                    <p>
                        <strong>Desc : </strong>{!! $item->has_product->mask_description ?? '' !!}
                    </p>
                </td>
                <td class="price">
                    {{ Helper::createRupiah($item->mask_price) ?? '' }}
                </td>
                <td class="qty">
                    {{ $item->mask_sent ?? '' }}
                </td>
                <td class="total">
                    @if($item->so_delivery_detail_discount_percent)
                    <span>
                        Disc : {{ $item->so_delivery_detail_discount_percent }}%
                    </span>
                    <span>
                        - {{ Helper::createRupiah($item->discount) }}
                    </span>
                    @endif
                    {{ Helper::createRupiah($total_value) ?? '' }}
                </td>
            </tr>
            @endforeach

            <tr class="total_product">
                <td class="product" colspan="7">
                    Total Product
                </td>
                <td class="total">
                    {{ Helper::createRupiah($total_value) ?? '' }}
                </td>
            </tr>

            <tr class="total_product">
                <td class="product" colspan="7">
                    Total Service
                </td>
                <td class="total">
                    {{ Helper::createRupiah($job_order->mask_value) ?? '' }}
                </td>
            </tr>

            @if (!empty($master->mask_discount))
            <tr class="total_discount">
                <td class="product" colspan="6">
                    {{ $master->so_discount_name ?? '' }}
                    Total Discount
                </td>
                <td class="qty">
                    {{ $master->so_discount_value ?? '' }}%
                </td>
                <td class="total">
                    -{{ Helper::createRupiah($total_discount) ?? '' }}
                </td>
            </tr>
            @endif
            @if (!empty($master->so_tax_percent))
            <tr class="total_discount">
                <td class="product" colspan="6">
                    {{ $master->tax->tax_name ?? '' }}
                </td>
                <td class="qty">
                    {{ $master->so_tax_percent ?? '' }}%
                </td>
                <td class="total">
                    {{ Helper::createRupiah($total_tax) ?? '' }}
                </td>
            </tr>
            @endif
            <tr class="total_sumary">
                <td class="product" colspan="7">
                   Grand Total
                </td>
                <td class="total">
                    {{ Helper::createRupiah($grand_total + $job_order->mask_value) ?? '' }}
                </td>
            </tr>

        </table>

    </div>
    
    <img style="position:absolute;width:130px;right:237px;margin-top:45px" src="{{ Helper::print('logo/mpe.png') }}">
    <div id="container">

        <table style="border-collapse:collapse;border:none;width:100% !important">
            <tbody>
                <tr>
                    <td class="position:relative" colspan="3" rowspan="1" style="width: 235.55pt;border: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <strong>INVOICE RECEIVER</strong>
                        </p>
                        <br>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_receiver_name ?? '' }}
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_receiver_address ?? '' }}
                        </p>
                        <br>
                        <p style='margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_receiver_npwp ?? '' }}
                        </p>
                    </td>
                    
                    <td colspan="2" style="width:148.25pt;border:solid windowtext 1.0pt;border-left:  none;padding:0in 5.4pt 0in 5.4pt;">
                        <p style='margin-top:10px;margin-right:0in;margin-bottom:50px;margin-left:135px;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
                            PT. MULTI PRATAMA EKSPRES
                        </p>

                        <p style='margin-top:5px;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            INVOICE NO : {{ $job_order->jo_code ?? '' }}
                        </p>
                        <p style='margin-top:5px;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            FILE REF.NO :  {{ $job_order->jo_ref_code ?? '' }}
                        </p>
                        <p style='margin-top:5px;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        INVOICE DATE : {{ $job_order->jo_invoice_date ? $job_order->jo_invoice_date->format('d F Y') : '' }}
                        </p>

                    </td>
                </tr>
              
                <tr>
                    <td colspan="3" style="width: 225.55pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <strong>SHIPPER</strong>
                        </p>
                        <br>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_shipper_name ?? '' }}
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_shipper_address ?? '' }}
                        </p>
                        <br>
                    </td>
                    <td colspan="2" style="width: 241.95pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <strong>NOTIFY PARTY</strong>
                        </p>
                        <br>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_notify_party_name ?? '' }}
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_notify_party_address ?? '' }}
                        </p>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width: 225.55pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <strong>CONSIGNEE</strong>
                        </p>
                        <br>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_consignee_name ?? '' }}
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_consignee_address ?? '' }}
                        </p>
                        <br>
                    </td>
                    <td colspan="2" style="width: 241.95pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <strong>FINAL AGENT</strong>
                        </p>
                        <br>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_agent_name ?? '' }}
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $job_order->jo_agent_address ?? '' }}
                        </p>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width: 111.8pt;border-top: none;border-right: 1pt solid windowtext;border-bottom: none;border-image: initial;border-left: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            BL NO : {{ $job_order->jo_master_bl ?? '' }}</p>
                    </td>

                    <td style="width: 93.7pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            VESSEL</p>
                    </td>
                    <td style="width: 148.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            : {{ $job_order->jo_vessel ?? '' }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width: 111.8pt;border-top: none;border-right: 1pt solid windowtext;border-bottom: none;border-image: initial;border-left: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            POL : {{ $job_order->jo_port_of_loading ?? '' }}</p>
                    </td>

                    <td style="width: 93.7pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            ETA DATE</p>
                    </td>
                    <td style="width: 148.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            : {{ $job_order->jo_eta ? $job_order->jo_eta->format('d F Y') : '' }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="width: 111.8pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            POD : {{ $job_order->jo_port_of_delivery ?? '' }}</p>
                    </td>

                    <td style="width: 93.7pt;border-top: none;border-right: none;border-left: none;border-image: initial;border-bottom: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            QUANTITY</p>
                    </td>
                    <td style="width: 148.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            : {{ $job_order->jo_total_weight ?? '' }} {{ $job_order->jo_unit_code ?? '' }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="width: 111.8pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <strong>CHARGES DETAIL : <br>&nbsp;</strong>
                        </p>
                    </td>
                    <td colspan="2" style="width: 113.75pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            &nbsp;</p>
                    </td>
                    <td style="width: 93.7pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            &nbsp;</p>
                    </td>
                    <td style="width: 148.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            &nbsp;</p>
                    </td>
                </tr>
                @if($job_order)
                @foreach($job_order->has_detail as $item)
                <tr>
                    <td colspan="4" style="width: 319.25pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: 0pt solid windowtext;border-right: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            {{ $item->has_product->service_name ?? '' }}
                        </p>
                    </td>
                    <td style="width: 148.25pt;border-top: none;border-left: none;border-bottom: 0pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:right;'>
                            IDR {{ Helper::createRupiah($item->mask_price) ?? '' }}
                        </p>
                    </td>
                </tr>
                @endforeach
                @endif
                <tr>
                    <td colspan="4" style="width: 319.25pt;border-top: 1pt solid windowtext;;border-left: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-right: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <strong>TOTAL DUE :</strong>
                        </p>
                    </td>
                    <td style="width: 148.25pt;border-top: 1pt solid windowtext;;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:right;'>
                            IDR {{ Helper::createRupiah($job_order->mask_value) ?? '' }}
                        </p>
                    </td>
                </tr>

            </tbody>

            <tbody>
                <tr>
                    <td colspan="4" style="width: 319.25pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-right: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <strong>Account Detail :</strong>
                        </p>
                        <p style='margin-top:10px;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:12px;font-family:"Calibri",sans-serif;'>
                            Bank Mandiri (Persero) Tbk.
                            <br>
                            PT. MULTI PRATAMA EKSPRES
                            <br>
                            A/C : 123-00-0767086-4
                        </p>
                    </td>
                    <td style="width: 148.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:right;'>
                            &nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="width:168.05pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <span style="font-size:12px;">PT. MULTI PRATAMA EKSPRES</span>
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <span style="font-size:12px;">JL. MANUNGGAL PRATAMA NO.8</span>
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <span style="font-size:12px;">RT.011 RW.006 CIPINANG MELAYU</span>
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <span style="font-size:12px;">MAKASAR.JAKARTA TIMUR - DKI JAKARTA</span>
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <span style="font-size:12px;">VAT NO.: 85.290.566.0-005.000</span>
                        </p>
                    </td>
                    <td colspan="2" style="width:2.1in;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <span style="font-size:12px;">Bank (Persero) Tbk.</span>
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <span style="font-size:12px;">Kantor Jakarta Ahmad Yan</span>
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <span style="font-size:12px;">PT. MULTI PRATAMA EKSPRES</span>
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                            <span style="font-size:12px;">A/C : 123-00-0767086-4</span>
                        </p>
                    </td>
                    <td style="width: 148.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
                            <span style="font-size:12px;">PT. PRATAMA EKSPRES</span><br>&nbsp;
                        </p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
                            &nbsp;</p>
                        <p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
                            <br>&nbsp;FANNY IRIANTY
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>