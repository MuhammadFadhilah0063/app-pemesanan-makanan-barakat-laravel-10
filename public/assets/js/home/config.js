// var myApp = 'https://4210-140-213-182-142.ngrok-free.app';
var myApp = 'http://127.0.0.1:8000';

// Mengatur token CSRF dalam header permintaan untuk setiap permintaan Ajax
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});