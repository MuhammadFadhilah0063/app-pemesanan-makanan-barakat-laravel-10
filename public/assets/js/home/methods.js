// Fungsi render ulang view component cart
function renderCart() {
  if ((document.location.pathname).startsWith('/reservation/online/order')) {
    var path = document.location.pathname;
    var pathArray = path.split('/');
    var lastPath = pathArray.pop();
    var url = myApp + '/reservation/online/order/' + lastPath;
  } else {
    var url = '';
  }

  $.ajax({
    url: url,
    method: 'GET',
    success: function (res) {
      var html = res;
      var btnCart = $('#btn_cart');
      btnCart.html(html)
    },
    error: function (e) {
      Swal.fire({
        title: 'Gagal',
        text: 'Terjadi kesalahan',
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Tutup',
      });
    }
  });
}

// Fungsi untuk memformat angka menjadi format rupiah
function formatRupiah(angka) {
  const reverse = angka.toString().split('').reverse().join('');
  const ribuan = reverse.match(/\d{1,3}/g);
  const rupiah = ribuan.join('.').split('').reverse().join('');
  return rupiah;
}

function formatDate(date) {
  var dateObj = new Date(date);
  var options = { day: 'numeric', month: 'long', year: 'numeric' };
  return dateObj.toLocaleDateString('id-ID', options);
}

// Fungsi set loading true
function loadingTrue() {
  $('#loading').removeClass('d-none');
  $('#loading').addClass('d-block');
}

// Fungsi set loading false
function loadingFalse() {
  $('#loading').removeClass('d-block');
  $('#loading').addClass('d-none');
}

// Fungsi set loading true
function loadingTrue2() {
  $('#loading2').removeClass('d-none');
  $('#loading2').addClass('d-block');
}

// Fungsi set loading false
function loadingFalse2() {
  $('#loading2').removeClass('d-block');
  $('#loading2').addClass('d-none');
}

// Fungsi mengubah total pada rincian order di halaman online order
function setTotal() {
  var elsubtotal = $('.subtotal');
  var subtotal = 0;

  elsubtotal.each(function () {
    var number = $(this).html().replace(/\D/g, "");
    subtotal += parseInt(number);
  })

  $('.total').html('Rp. ' + formatRupiah(subtotal));
}

// Fungsi mengubah total pada modal rincian offline order
function setTotalOrder() {
  var elsubtotal = $('.subtotal-order');
  var subtotal = 0;

  elsubtotal.each(function () {
    var number = $(this).html().replace(/\D/g, "");
    subtotal += parseInt(number);
  })

  $('.total-order').html('Rp. ' + formatRupiah(subtotal));
}

// Fungsi menampilkan error dengan sweet alert 2
function showError() {
  loadingFalse();
  Swal.fire({
    title: 'Gagal',
    text: 'Terjadi kesalahan',
    icon: 'error',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Tutup',
  });
}

// Fungsi untuk disable checkbox input quantity, jika value == 0
function disabledCheckbox(element) {
  var grandParent = element.parent().parent().parent();
  var check = grandParent.find('.checkCart')
  var quantity = element.parent().find('.input-quantity').val();

  if (quantity == '0') {
    check.prop('disabled', true);
    check.prop('checked', false);
  }
}

// Fungsi untuk undisable checkbox input quantity, jika value != 0
function undisabledCheckbox(element) {
  var grandParent = element.parent().parent().parent();
  var check = grandParent.find('.checkCart')
  var quantity = element.parent().find('.input-quantity').val();

  if (quantity != '0') {
    check.prop('disabled', false);
  }
}

// Fungsi untuk menampilkan alert berhasil dengan sweet alert 2
function alertSuccess(text) {
  Swal.fire({
    title: 'Berhasil',
    text: text,
    icon: 'success',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Tutup',
  });
}

// Fungsi untuk menampilkan alert error dan action konfirmasi dengan sweet alert 2
function alertErrorWithConfirmToLocation(text, location) {
  Swal.fire({
    title: 'Gagal',
    text: text,
    icon: 'error',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Tutup',
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = location;
    }
  });
}

// Fungsi untuk menampilkan alert success dan action konfirmasi dengan sweet alert 2
function alertSuccessWithConfirmToLocation(text, location) {
  Swal.fire({
    title: 'Berhasil',
    text: text,
    icon: 'success',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Tutup',
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = location;
    }
  });
}

// Fungsi untuk menampilkan alert error dengan sweet alert 2
function alertError(text) {
  Swal.fire({
    title: 'Gagal',
    text: text,
    icon: 'error',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Tutup',
  });
}

// Fungsi untuk menampilkan toast berhasil dengan iziToast
function iziToastSuccess(message) {
  iziToast.show({
    title: 'Berhasil',
    message: message,
    position: 'bottomLeft',
    backgroundColor: '#65BB6A',
    messageColor: 'white'
  });
}

// Fungsi bulan indonesia
function getMonthName(monthNumber) {
  const months = [
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  ];

  // Mengonversi angka bulan menjadi indeks array (dikurangi 1 karena indeks array dimulai dari 0)
  const monthIndex = parseInt(monthNumber) - 1;

  // Mengembalikan nama bulan
  return months[monthIndex];
}



