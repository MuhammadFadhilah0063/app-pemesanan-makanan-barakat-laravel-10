<script>
  // Render DataTable
$(document).ready(function () {
  $('#table_user').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    colReorder: true,
    ajax: {
      'url': '{{ url()->current() }}',
      'data': function (d) {
        d.role = $('#status').val();
      }
    },
    columns: [
      {
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        orderable: false,
        searchable: false,
        render: function (data) {
          // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
          return new Intl.NumberFormat('id-ID').format(data);
        }
      },
      { data: 'name' },
      { data: 'username' },
      { data: 'phone' },
      { data: 'role' },
      {
        data: 'actions',
        name: "actions",
        orderable: false,
        searchable: false
      }
    ],
    language: language, // from config
    columnDefs: [
      { targets: 0, width: '1%', className: "text-lg-center align-middle text-capitalize" },
      { targets: 1, width: '30%', className: "align-middle" },
      { targets: 2, className: "align-middle" },
      { targets: 5, width: '15%', className: "text-lg-center align-middle text-capitalize" },
      { targets: [3, 4], className: "text-lg-center align-middle text-capitalize" },
    ]
  });

  // Filter status
  $('#status').change(function () {
    reloadTable('#table_user');
  });
});

// Fungsi reload datatable
function reloadTable(id) {
  let table = $(id).DataTable();
  table.cleanData;
  table.ajax.reload();
}

// Mengatur token CSRF dalam header permintaan untuk setiap permintaan Ajax
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// Button edit 
$('body').on('click', '#btn-edit', function (e) {
  ajaxStart();
  let id = $(this).data('id');

  $.ajax({
    url: 'user/' + id + '/edit',
    type: 'GET',
    success: function (response) {
      ajaxStop();
      $('#modalAddUser').modal('show');
      $('#changeStatus').val(response.data.role);
      $('#inputId').val(id);
    },
    error: function (e) {
      ajaxStop();
      console.log('Terjadi kesalahan saat mengambil data');
    }
  });
});

// Fungsi btn update
$('#submit').on('click', function (e) {
  e.preventDefault();
  var id = $('#inputId').val();

  update(id)
})

// fungsi update
function update(id = '') {
  ajaxStart();
  $.ajax({
    url: 'user/' + id,
    method: 'POST',
    data: {
      status: $('#changeStatus').val(),
      _method: 'PUT'
    },
    success: function (response) {
      ajaxStop();
      Swal.fire({
        title: 'Berhasil',
        text: "Status pengguna berhasil diubah!",
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Tutup',
      })
      $('#modalAddUser').modal('hide');
      reloadTable('#table_user')
    },
    error: function() {
      ajaxStop();
      console.log('error');
    }
  });
}

// 04_PROSES Delete 
$('body').on('click', '#btn-delete', function (e) {
  Swal.fire({
    title: 'Apakah kamu yakin hapus ini?',
    text: "Data ini tidak bisa dikembalikan lagi!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      ajaxStart();
      var id = $(this).data('id');
      $.ajax({
        url: 'user/' + id,
        type: 'DELETE',
        success: function() {
          ajaxStop();

          Swal.fire(
            'Berhasil!',
            'Pengguna berhasil dihapus!',
            'success'
          )

          $('#table_user').DataTable().ajax.reload();
        },
        error: function() {
          ajaxStop();
          Swal.fire(
            'Gagal!',
            'Terjadi kesalahan!',
            'error'
          );
        }
      });
    }
  })
});
</script>