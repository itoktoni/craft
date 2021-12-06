<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<style>
table tr td {
    padding-top: 5px !important;
    padding-bottom: 5px !important;
}

.no-padding {
    padding-top: 0px !important;
    padding-bottom: 0px !important;
}

.no-padding p {
    line-height: 5px;
}
</style>

<body style="margin-left: -10px;">
    <table style="border-collapse:collapse;border:none;">
        <tbody>
            <tr>
                <td class="position:relative" colspan="3" rowspan="5"
                    style="width: 225.55pt;border: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <strong>INVOICE RECEIVER</strong>
                    </p>
                    <br>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_receiver_name ?? '' }}
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_receiver_address ?? '' }}
                    </p>
                    <br>
                    <p
                        style='position:absolute;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_receiver_npwp ?? '' }}
                    </p>
                </td>
                <td
                    style="width:93.7pt;border-top:solid windowtext 1.0pt;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:none;padding:0in 5.4pt 0in 5.4pt;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
                        <img width="101"
                            src="https://myfiles.space/user_files/103444_557a6973d1152da1/103444_custom_files/img1635827715.png"
                            alt="Logo

Description automatically generated">
                    </p>
                </td>
                <td
                    style="width:148.25pt;border:solid windowtext 1.0pt;border-left:  none;padding:0in 5.4pt 0in 5.4pt;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
                        PT. MULTI PRATAMA EKSPRES
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="width: 241.95pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        I N V O I C E</p>
                </td>
            </tr>
            <tr>
                <td class="no-padding" style="width: 93.7pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        INVOICE NO</p>
                </td>
                <td class="no-padding"
                    style="width: 148.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        : {{ $job_order->jo_code ?? '' }}</p>
                </td>
            </tr>
            <tr>
                <td class="no-padding" style="width: 93.7pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        FILE REF.NO</p>
                </td>
                <td class="no-padding"
                    style="width: 148.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        : {{ $job_order->jo_ref_code ?? '' }}</p>
                </td>
            </tr>
            <tr>
                <td class="no-padding"
                    style="width: 93.7pt;border-top: none;border-right: none;border-left: none;border-image: initial;border-bottom: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        INVOICE DATE</p>
                </td>
                <td class="no-padding"
                    style="width: 148.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        : {{ $job_order->jo_invoice_date ? $job_order->jo_invoice_date->format('d F Y') : '' }}</p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 225.55pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <strong>SHIPPER</strong>
                    </p>
                    <br>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_shipper_name ?? '' }}
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_shipper_address ?? '' }}
                    </p>
                </td>
                <td colspan="2"
                    style="width: 241.95pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <strong>NOTIFY PARTY</strong>
                    </p>
                    <br>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_notify_party_name ?? '' }}
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_notify_party_address ?? '' }}
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 225.55pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <strong>CONSIGNEE</strong>
                    </p>
                    <br>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_consignee_name ?? '' }}
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_consignee_address ?? '' }}
                    </p>
                </td>
                <td colspan="2"
                    style="width: 241.95pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <strong>FINAL AGENT</strong>
                    </p>
                    <br>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_agent_name ?? '' }}
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $job_order->jo_agent_address ?? '' }}
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 111.8pt;border-top: none;border-right: 1pt solid windowtext;border-bottom: none;border-image: initial;border-left: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        BL NO : {{ $job_order->jo_master_bl ?? '' }}</p>
                </td>

                <td style="width: 93.7pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        VESSEL</p>
                </td>
                <td
                    style="width: 148.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        : {{ $job_order->jo_vessel ?? '' }}</p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 111.8pt;border-top: none;border-right: 1pt solid windowtext;border-bottom: none;border-image: initial;border-left: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        POL : {{ $job_order->jo_port_of_loading ?? '' }}</p>
                </td>

                <td style="width: 93.7pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        ETA DATE</p>
                </td>
                <td
                    style="width: 148.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        : {{ $job_order->jo_eta ? $job_order->jo_eta->format('d F Y') : '' }}</p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 111.8pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        POD : {{ $job_order->jo_port_of_delivery ?? '' }}</p>
                </td>

                <td
                    style="width: 93.7pt;border-top: none;border-right: none;border-left: none;border-image: initial;border-bottom: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        QUANTITY</p>
                </td>
                <td
                    style="width: 148.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        : {{ $job_order->jo_total_weight ?? '' }} {{ $job_order->jo_unit_code ?? '' }}</p>
                </td>
            </tr>
            <tr>
                <td
                    style="width: 111.8pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <strong>CHARGES DETAIL : <br>&nbsp;</strong>
                    </p>
                </td>
                <td colspan="2" style="width: 113.75pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        &nbsp;</p>
                </td>
                <td style="width: 93.7pt;border: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        &nbsp;</p>
                </td>
                <td
                    style="width: 148.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        &nbsp;</p>
                </td>
            </tr>
            @if($job_detail)
            @foreach($job_detail as $item)
            <tr>
                <td colspan="4"
                    style="width: 319.25pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: 0pt solid windowtext;border-right: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        {{ $item->has_product->service_name ?? '' }}
                    </p>
                </td>
                <td
                    style="width: 148.25pt;border-top: none;border-left: none;border-bottom: 0pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:right;'>
                        IDR {{ Helper::createRupiah($item->mask_price) ?? '' }}
                    </p>
                </td>
            </tr>
            @endforeach
            @endif
            <tr>
                <td colspan="4"
                    style="width: 319.25pt;border-top: 1pt solid windowtext;;border-left: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-right: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <strong>TOTAL DUE :</strong>
                    </p>
                </td>
                <td
                    style="width: 148.25pt;border-top: 1pt solid windowtext;;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:right;'>
                        IDR {{ Helper::createRupiah($job_order->mask_value) ?? '' }}
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="4"
                    style="width: 319.25pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-right: none;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <strong>Account Detail :</strong>
                    </p>
                    <p
                        style='margin-top:10px;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:12px;font-family:"Calibri",sans-serif;'>
                        Bank Mandiri (Persero) Tbk.
                        <br>
                        PT. MULTI PRATAMA EKSPRES
                        <br>
                        A/C : 123-00-0767086-4
                    </p>
                </td>
                <td
                    style="width: 148.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:right;'>
                        &nbsp;</p>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="width:168.05pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style="font-size:12px;">PT. MULTI PRATAMA EKSPRES</span>
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style="font-size:12px;">JL. MANUNGGAL PRATAMA NO.8</span>
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style="font-size:12px;">RT.011 RW.006 CIPINANG MELAYU</span>
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style="font-size:12px;">MAKASAR.JAKARTA TIMUR - DKI JAKARTA</span>
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style="font-size:12px;">VAT NO.: 85.290.566.0-005.000</span>
                    </p>
                </td>
                <td colspan="2"
                    style="width:2.1in;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style="font-size:12px;">Bank (Persero) Tbk.</span>
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style="font-size:12px;">Kantor Jakarta Ahmad Yan</span>
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style="font-size:12px;">PT. MULTI PRATAMA EKSPRES</span>
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style="font-size:12px;">A/C : 123-00-0767086-4</span>
                    </p>
                </td>
                <td
                    style="width: 148.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0in 5.4pt;vertical-align: top;">
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
                        <span style="font-size:12px;">PT. PRATAMA EKSPRES</span><br>&nbsp;
                    </p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
                        &nbsp;</p>
                    <p
                        style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:0in;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
                        <br>&nbsp;FANNY IRIANTY
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>