<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/logo/bt2.png'))) }}"
    rel="icon" type="image/png">
  <title>Bukti Pembayaran</title>
  {{-- Bootstrap --}}
  <link
    href="data:text/css;base64,{{ base64_encode(file_get_contents(public_path('/assets/css/home/bootstrap.min.css'))) }}"
    rel="stylesheet" type="text/css">

  <style>
    body {
      background-color: transparent !important;
    }

    .invoice-box {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, .15);
      font-size: 16px;
      line-height: 24px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #555;
    }

    .invoice-box table {
      width: 100%;
      line-height: normal;
      /* inherit */
      text-align: left;
    }

    .invoice-box table td {
      padding: 5px;
      vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
      text-align: right;
    }

    .invoice-box table tr.top table td {
      padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
      font-size: 45px;
      line-height: 45px;
      color: #333;
    }

    .invoice-box table tr.information table td {
      padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
      background: #eee;
      border-bottom: 1px solid #ddd;
      font-weight: bold;
    }

    .invoice-box table tr.details td {
      padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
      border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
      border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
      border-top: 2px solid #eee;
      font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
      .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
      }

      .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
      }
    }

    /** RTL **/
    .rtl {
      direction: rtl;
      font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
      text-align: right;
    }

    .rtl table tr td:nth-child(2) {
      text-align: left;
    }
  </style>
</head>

<body>
  <div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="2">
          <table>
            <tr>
              <td class="title">
                <img
                  src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/logo/bt2.png'))) }}"
                  width="150px">
              </td>

              <td>
                No. Pesanan : <strong>{{ $order->offline_order_id }}</strong><br>
                {{ formatDateWithTime($order->created_at) }}<br>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="information">
        <td colspan="2">
          <table>
            <tr>
              <td>
                <strong>PEMESAN</strong><br>
                {{ $order->name }}<br>
                {{ $order->phone }}<br>
              </td>

              <td>
                <strong>PEMILIK</strong><br>
                H. Bajuri<br>
                085388818880<br>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="heading">
        <td>Keterangan</td>
        <td>Subtotal</td>
      </tr>

      @foreach ($order->order_items as $row)
      <tr class="item">
        <td>
          {{ $row->food->name }}<br>
          <strong>Harga</strong>: {{ rupiah($row->food->price) }} x {{ $row->quantity }}
        </td>
        <td>{{ rupiah($row->food->price * $row->quantity) }}</td>
      </tr>
      @endforeach

      <tr style="font-weight: bold">
        <td></td>
        <td>
          Total: {{ rupiah($order->total) }}
        </td>
      </tr>

      @if ($order->payment)
      <tr>
        <td><strong>Detail Pembayaran</strong></td>
        <td></td>
      </tr>
      <tr>
        <td>Tanggal: {{ formatDateWithTime2($order->payment->updated_at) }}</td>
        <td></td>
      </tr>
      @endif
    </table>
  </div>
</body>

</html>