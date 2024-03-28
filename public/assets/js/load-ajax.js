var preloader = $('#preloaderAjax');

// Menampilkan loader saat permintaan AJAX dimulai
function ajaxStart() {
  preloader.removeClass('d-none');
}

// Menyembunyikan loader saat permintaan AJAX selesai
function ajaxStop() {
  preloader.addClass('d-none');
}