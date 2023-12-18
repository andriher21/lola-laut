<html>

<head>
    <title>Regio Personnel</title>
</head>

<body>
    <!-- <body> -->
    <!--  -->

    <style>
        @page {
            /* auto is the initial value */

            /* this affects the margin in the printer settings */

            size: A4 landscape;
        }

        @media print {
            tr.page-break {
                display: block;
                page-break-before: always;
            }
        }

        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }

        * {
            font-family: sans-serif;
        }

        .table1 {
            font-family: sans-serif;
            color: #444;
            border-collapse: collapse;
            width: 100%;
            font-size: 10px !important;
        }

        .table-header {
            font-family: sans-serif;
            color: #444;
            border-collapse: collapse;
            width: 100%;
            font-size: 10px !important;
        }

        .table1 tr th {
            background: #f2f2f2;
            color: #000;
            font-weight: normal;
            white-space: nowrap;
            /* text-align:right; */
        }

        .table-header tr th {
            background: #35A9DB;
            color: #000;
            font-weight: normal;
            /* text-align:right */
        }

        th {
            font-weight: 700 !important;
        }


        .table1,
        th {
            padding: 5px 10px;
            border: 1px solid #9a9a9a;
        }

        .table1,
        td {
            padding: 4px 15px;
            border: 1px solid #9a9a9a;
            white-space: nowrap;
        }

        .table-header>thead>th>td,
        .table-header>tbody>tr>td {
            padding: 2px 2px;
            border: none;
        }

        th {
            /* text-align:left !important; */
        }

        .table1 tr:hover {
            background-color: #f5f5f5;
        }

        .table1 tr:nth-child(even) {
            /* background-color: #f2f2f2; */
        }

        .text-right {
            text-align: right;
        }

        body {
            /* this affects the margin on the content before sending to printer */
            margin: 0px;
            font-size: 14px !important;
        }

        .text-center {
            text-align: center;
        }

        .weigh_in {
            width: 70px;
        }

        .header {
            width: 120px;
        }

        .bordered-top {
            border-top: 1px dashed black;
        }

        .bordered-bottom {
            border-bottom: 1px dashed black;
        }

        .text-right {
            text-align: right;
        }
    </style>
    <div colspan="2" class="text-center">Transaction Report</div>

    <hr>
    <table class="table-header">
        <tbody>
            <tr>
                <td width="100px">Date</td>
                <td>: <?php echo date('jS F Y', strtotime($dates)) ?></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table class="table1">
        <thead>
            <tr>
            <th width="5px">No</th>
            
                                        <th >Jenis </th>
                                        <th>No Vehicle</th>
                                        <th>Company</th>
                                        <th>Driver</th>
                                        <th>jenis Vehicle </th>
                                        <th>Material </th>
                                        <th>Weight IN </th>
                                        <th>Weight OUT </th>
                                        <th>Weight Nett </th>
                                        <th>Time In </th>
                                        <th>Time OUT </th>
                                        <th>Volume Ton</th>
                                        <th>Volume M3</th>
                                        <th>Total Ton</th>
                                        <th>Total M3 </th>
        </thead>
        <tbody>
            <?php if (empty($report)) { ?>
                <tr>
                    <td colspan="9" class="text-center">No Data.</td>
                </tr>
            <?php } else { ?>
                <?php $count = 0;
                foreach ($report as $r) : ?>
                    <tr>
                    <td><?= ++$count; ?><td><?= $r['jenis_transaksi']; ?></td>
                                            <td><?= $r['vehicle']; ?></td>
                                            <td><?= $r['company']; ?></td>
                                            <td><?= $r['driver']; ?></td>
                                            <td><?= $r['jenis_vcl']; ?></td>
                                            <td><?= $r['material']; ?></td>
                                            <td class='text-right' ><?= number_format($r['weight_in']); ?></td>
                                            <td class='text-right'><?= number_format($r['weight_out']); ?></td>
                                            <td class='text-right'><?= number_format($r['nett_weight']); ?></td>
                                            <td><?= $r['date_in']; ?></td>
                                            <td><?= $r['date_out']; ?></td>
                                            <td><?= $r['vol_ton']; ?></td>
                                            <td><?= $r['vol_kubik']; ?></td>
                                            <td><?= $r['total_ton']; ?></td>
                                            <td><?= $r['total_kubik']; ?></td>
                    </tr>

                <?php endforeach ?>
            <?php } ?>

        </tbody>
    </table>
    <br>

    <script>
        window.onload = function() {
            // parent.iframeLoaded();
            window.print();
        }
    </script>

</body>

</html>