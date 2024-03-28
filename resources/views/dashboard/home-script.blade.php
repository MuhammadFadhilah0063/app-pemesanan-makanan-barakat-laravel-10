<script>
  // Render DataTable
  $(document).ready(function () {
    $('#table_reservation').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,
      colReorder: true,
      language: language, // from config
      createdRow: function(row, data, dataIndex){
        $('td:eq(2)', row).css('min-width', '180px');
      },
      ajax: {
        'url': '{{ url()->current() }}',
      },
      columns: [
        { 
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false,
          render: function (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              return new Intl.NumberFormat('id-ID').format(data);
          }
        },
        { data: 'reservation_id' },
        { data: 'name' },
        { 
          data: 'reservation_time', 
          searchable: false,
          render: function (data) {
            return data.substring(0, 5);
          } 
        },
        { 
          data: 'actions', 
          orderable: false, 
          searchable: false   
        }
      ],
      columnDefs: [
        { targets: 0, width: '1px', className: "text-center align-middle text-capitalize" },
        { targets: 1, width: '200px', className: "align-middle text-capitalize text-nowrap" },
        { targets: 2, className: "align-middle text-capitalize" },
        { targets: [3, 4], className: "text-center align-middle text-capitalize text-nowrap" },
      ]
    });
  });

  // chart js start //

  // pesanan online start
  var ctx = document.getElementById('myChart').getContext('2d');
  var dataPesanan = @json($dataPesanan);

  // Fungsi untuk mengubah angka bulan menjadi nama bulan Bahasa Indonesia
  function getBulanIndonesia(bulanAngka) {
      var namaBulan = [
          "Januari", "Februari", "Maret", "April", "Mei", "Juni",
          "Juli", "Agustus", "September", "Oktober", "November", "Desember"
      ];
      return namaBulan[bulanAngka - 1];
  }

  var bulanLabels = dataPesanan.map(item => getBulanIndonesia(item.bulan));
  var jumlahTransaksiData = dataPesanan.map(item => item.jumlah_transaksi);

  var chartData = {
      labels: bulanLabels,
      datasets: [{
          label: 'Jumlah Pesanan Online',
          data: jumlahTransaksiData,
          backgroundColor: 'rgba(103, 119, 239, 0.6)',
          borderColor: 'rgba(76, 96, 218, 0.9)',
          borderWidth: 1
      }]
  };

  var myChart = new Chart(ctx, {
      type: 'bar',
      data: chartData,
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
  // pesanan online end


  // pesanan offline start
  var ctx = document.getElementById('myChart2').getContext('2d');
  var dataPesanan = @json($dataPesanan2);

  // Fungsi untuk mengubah angka bulan menjadi nama bulan Bahasa Indonesia
  function getBulanIndonesia(bulanAngka) {
      var namaBulan = [
          "Januari", "Februari", "Maret", "April", "Mei", "Juni",
          "Juli", "Agustus", "September", "Oktober", "November", "Desember"
      ];
      return namaBulan[bulanAngka - 1];
  }

  var bulanLabels = dataPesanan.map(item => getBulanIndonesia(item.bulan));
  var jumlahTransaksiData = dataPesanan.map(item => item.jumlah_transaksi);

  var chartData = {
      labels: bulanLabels,
      datasets: [{
          label: 'Jumlah Pesanan Offline',
          data: jumlahTransaksiData,
          backgroundColor: 'rgba(103, 219, 239, 0.6)',
          borderColor: 'rgba(103, 219, 250, 0.9)',
          borderWidth: 1
      }]
  };

  var myChart = new Chart(ctx, {
      type: 'bar',
      data: chartData,
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
  // pesanan offline end


  // reservasi online start
  var ctx = document.getElementById('myChart3').getContext('2d');
  var dataReservasi = @json($dataReservasi);

  // Fungsi untuk mengubah angka bulan menjadi nama bulan Bahasa Indonesia
  function getBulanIndonesia(bulanAngka) {
      var namaBulan = [
          "Januari", "Februari", "Maret", "April", "Mei", "Juni",
          "Juli", "Agustus", "September", "Oktober", "November", "Desember"
      ];
      return namaBulan[bulanAngka - 1];
  }

  var bulanLabels = dataReservasi.map(item => getBulanIndonesia(item.bulan));
  var jumlahTransaksiData = dataReservasi.map(item => item.jumlah_transaksi);

  var chartData = {
      labels: bulanLabels,
      datasets: [{
          label: 'Jumlah Reservasi Online',
          data: jumlahTransaksiData,
          backgroundColor: 'rgba(13, 249, 159, 0.6)',
          borderColor: 'rgba(13, 249, 159, 0.9)',
          borderWidth: 1
      }]
  };

  var myChart = new Chart(ctx, {
      type: 'bar',
      data: chartData,
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
  // reservasi online end


  // reservasi online start
  var ctx = document.getElementById('myChart4').getContext('2d');
  var dataReservasi = @json($dataReservasi2);

  // Fungsi untuk mengubah angka bulan menjadi nama bulan Bahasa Indonesia
  function getBulanIndonesia(bulanAngka) {
      var namaBulan = [
          "Januari", "Februari", "Maret", "April", "Mei", "Juni",
          "Juli", "Agustus", "September", "Oktober", "November", "Desember"
      ];
      return namaBulan[bulanAngka - 1];
  }

  var bulanLabels = dataReservasi.map(item => getBulanIndonesia(item.bulan));
  var jumlahTransaksiData = dataReservasi.map(item => item.jumlah_transaksi);

  var chartData = {
      labels: bulanLabels,
      datasets: [{
          label: 'Jumlah Reservasi Offline',
          data: jumlahTransaksiData,
          backgroundColor: 'rgba(90, 79, 19, 0.6)',
          borderColor: 'rgba(90, 79, 19, 0.9)',
          borderWidth: 1
      }]
  };

  var myChart = new Chart(ctx, {
      type: 'bar',
      data: chartData,
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
  // reservasi online end

  // chart js end //
</script>