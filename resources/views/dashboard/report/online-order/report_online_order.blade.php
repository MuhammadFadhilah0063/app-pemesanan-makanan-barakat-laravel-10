<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/logo/bt2.png'))) }}"
    rel="icon" type="image/png">
  <title>Cetak {{ $title }}</title>

  {{-- Bootstrap --}}
  <link
    href="data:text/css;base64,{{ base64_encode(file_get_contents(public_path('/assets/css/home/bootstrap.min.css'))) }}"
    rel="stylesheet" type="text/css">

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: transparent !important;
    }

    .page-break {
      page-break-after: always;
    }

    /* Kop title Start */
    .kop-report {
      position: relative;
      margin-top: 20pt;
    }

    .kop-report p {
      line-height: 0.6;
      color: black;
    }

    .kop-report p#warung {
      font-size: 23pt;
      font-weight: bold;
      color: black;
    }

    .kop-report p#jalan {
      margin-top: -1pt;
      font-size: 12t;
      color: black;
    }

    #logo {
      position: absolute;
      top: -24px;
      left: 150px;
      width: 90px;
      height: 80px;
      border: 2px solid #0000005a;
      border-radius: 15px;
      color: black;
    }

    /* Kop title End */

    /* Garis Start */
    #garis {
      border-top: 2pt solid black;
      margin-top: 7px;
      margin-left: -50px;
      margin-right: -100px;
      color: black;
    }

    #garis2 {
      border-top: 1px solid black;
      margin-top: 1px;
      margin-left: -100px;
      margin-right: -100px;
      color: black;
    }

    /* Garis End */

    /* Isi Start */
    .header #title {
      margin-top: 20px;
      font-weight: bold;
      font-size: 15pt;
      text-transform: uppercase;
      color: black;
    }

    .row table,
    tr,
    th,
    td {
      border: 2px solid;
      text-align: center;
      vertical-align: middle;
      color: black;
    }

    th {
      padding-bottom: 9px;
      padding-top: 9px;
      text-transform: capitalize;
      background-color: #F1EFE7;
      color: black;
    }

    .row {
      margin-top: 30px;
      margin-left: 0;
      margin-right: 0;
    }

    #tahun {
      margin-top: -14px;
      font-weight: bold;
      text-transform: uppercase;
      font-size: 15pt;
      color: black;
    }

    td {
      padding-left: 7px;
      padding-right: 7px;
      padding-top: 7px;
      padding-bottom: 7px;
      font-size: 16px;
      color: black;
    }

    p.dibuat {
      font-size: 16px;
      margin-top: 40px;
      margin-left: 935px;
      color: black;
    }

    p.tanggal-cetak {
      font-size: 16px;
      margin-top: -8px;
      margin-left: 935px;
      color: black;
    }

    .footer table {
      font-size: 16px;
      margin-top: 30px;
      margin-left: 925px;
      border: none !important;
      color: black;
    }

    .footer-tr {
      border: none !important;
    }

    .footer-td {
      border: none !important;
    }

    .footer {
      page-break-inside: avoid;
    }

    /* Isi End */
  </style>
</head>

<body>
  <div class="body">
    <section class="kop-report text-center">
      <p id="warung">WARUNG BARAKAT TARIM</p>
      <p id="jalan">
        Jl. A. Yani, Kupang, Tapin Utara, Kabupaten Tapin, Kalimantan Selatan 71152
      </p>
      <img id="logo" class="rounded shadow"
        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/logo/bt2.png'))) }}">
    </section>

    <div id="garis"></div>
    <div id="garis2"></div>

    <div class="header">
      @if(isset($year))
      <p id="title" class="text-center">
        Laporan Pesanan Online
      </p>
      @else
      <p id="title" class="text-center">
        Laporan Semua Pesanan Online
      </p>
      @endif

      @if (isset($year) && isset($month))
      <p id="tahun" class="text-center">Bulan {{ $month }} Tahun {{ $year }}</p>
      @elseif (isset($year))
      <p id="tahun" class="text-center">Tahun {{ $year }}</p>
      @endif
    </div>

    <div class="row">
      <table>
        <tr>
          <th>No.</th>
          <th>Nomor Pesanan</th>
          <th>Nama</th>
          <th>Tanggal Pengambilan</th>
          <th>Status Pesanan</th>
          <th>Pembayaran</th>
          <th>Total</th>
          <th>Reservasi</th>
        </tr>
        @foreach ($order as $item)
        <tr>
          <td width="25px">{{ $loop->iteration }}</td>
          <td width="150px" style="text-align: left; text-transform: capitalize;">{{ $item->online_order_id }}</td>
          <td style="text-align: left; text-transform: capitalize;">
            {{ $item->name }}
          </td>
          <td width="163px">
            {{ formatDate($item->pick_up_date) }}
          </td>
          <td width="118px">{{ $item->status }} </td>
          <td width="98px">{{ $item->payment_method }}</td>
          <td width="130px" style="text-align: left; text-transform: capitalize;">
            {{ rupiah($item->total) }}
          </td>
          <td width="160px"
            style="text-align: @if($item->reservation_id) left @else center @endif; text-transform: capitalize;">
            @if ($item->reservation_id)
            {{ $item->reservation_id }}
            @else
            -
            @endif
          </td>
        </tr>
        @endforeach
        <tr>
          <th colspan="6">Total Pesanan Status Pending</th>
          <th colspan="2">{{ ribu($pending) }} pesanan</th>
        </tr>
        <tr>
          <th colspan="6">Total Pesanan Status Process</th>
          <th colspan="2">{{ ribu($process) }} pesanan</th>
        </tr>
        <tr>
          <th colspan="6">Total Pesanan Status Success</th>
          <th colspan="2">{{ ribu($success) }} pesanan</th>
        </tr>
        <tr>
          <th colspan="6">Total Pesanan Status Failed</th>
          <th colspan="2">{{ ribu($failed) }} pesanan</th>
        </tr>
        <tr>
          <th colspan="6">Total Semua Pesanan</th>
          <th colspan="2">{{ ribu(count($order)) }} pesanan</th>
        </tr>
        <tr>
          <th colspan="6">Total Pendapatan</th>
          <th colspan="2">{{ rupiah($totalRevenue) }}</th>
        </tr>
      </table>
    </div>

    <div class="footer">
      <table class="footer-table">
        <tr class="footer-tr">
          <td class="footer-td">Dibuat pada tanggal,</td>
        </tr>
        <tr class="footer-tr">
          <td class="footer-td" style="padding-top: 1px;">{{ $dateNow }}</td>
        </tr>

        {{-- tr spasi start --}}
        <tr class="footer-tr">
          <td class="footer-td"></td>
        </tr>
        <tr class="footer-tr">
          <td class="footer-td"></td>
        </tr>
        <tr class="footer-tr">
          <td class="footer-td"></td>
        </tr>
        <tr class="footer-tr">
          <td class="footer-td"></td>
        </tr>
        <tr class="footer-tr">
          <td class="footer-td"></td>
        </tr>
        {{-- tr spasi end --}}

        <tr class="footer-tr">
          <td class="footer-td" style="padding-bottom: 0px;">H.Bajuri</td>
        </tr>
        <tr class="footer-tr">
          <td class="footer-td" style="padding-top: 0px;">Pemilik Warung</td>
        </tr>
      </table>
    </div>
  </div>

  {{-- Bootstrap --}}
  <script
    src="data:text/javascript;base64,{{ base64_encode(file_get_contents(public_path('/assets/js/bootstrap.bundle.min.js'))) }}">
  </script>
</body>

</html>