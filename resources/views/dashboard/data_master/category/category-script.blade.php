<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_category').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      colReorder: true,
      language: language, // from config
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
        { data: 'name' },
        { data: 'slug' },
        { 
          data: 'actions', 
          orderable: false, 
          searchable: false 
        }
      ],
      columnDefs: [
        { targets: 0, width: '1%', className: "text-lg-center align-middle text-capitalize" },
        {
          targets: [1, 2],
          className: "align-middle"
        },
        {
          targets: 3,
          width: '30%',
          className: "text-lg-center align-middle text-capitalize"
        },
      ]
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

  // Fungsi slug
  $('#inputCategory').on('input', function() {
    var category = $(this).val();
    var slug = category.trim().toLowerCase().replace(/\s+/g, '-');
    $('#inputSlug').val(slug);
  });

  // Button edit 
  $('body').on('click', '#btn-edit', function(e) {
    ajaxStart();
    let id = $(this).data('id');

    $.ajax({
      url: 'category/' + id + '/edit',
      type: 'GET',
      success: function(response) {
        ajaxStop();
        $('#inputCategory').val(response.data.name);
        $('#inputSlug').val(response.data.slug);
        $('#inputId').val(id);
        $('#exampleModalCenterTitle').html('Ubah Kategori');
        $('#submit').html('Ubah');
        
        $('#modalCategory').modal('show');
      },
      error: function(e) {
        ajaxStop();
        console.log('Terjadi kesalahan saat mengambil data');
      }
    });
  });

  // Button add / create
  $('body').on('click', '#btn-add', function(e) {
    // Clear data
    $('#inputCategory').val('');
    $('#inputSlug').val('');
    $('#inputId').val('');

    $('#exampleModalCenterTitle').html('Tambah Kategori');
    $('#submit').html('Tambah');
    
    $('#modalCategory').modal('show');
  });

  // Proses update or store
  $('#submit').on('click', function (e) {
    ajaxStart();
    var category = $('#inputCategory').val()
    var slug = $('#inputSlug').val()

    if(!$('#inputId').val()) {
      // Proses store
      var url = 'category';
      var method = 'POST';
    }else {
      // Proses update
      var id = $('#inputId').val();
      var url = 'category/' + id;
      var method = 'PUT';
    }

    var data = {
      name: category,
      slug: slug,
    };

    $.ajax({
      url: url,
      method: method,
      data: data,
      success: function(response) {
        ajaxStop();
        Swal.fire({
          title: 'Berhasil',
          text: (method == 'PUT' ? 'Kategori berhasil diubah!' : 'Kategori baru berhasil ditambahkan!'),
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Tutup',
        })
        $('#modalCategory').modal('hide');
        reloadTable('#table_category')
      },
      error: function(e) {
        console.clear();
        errors = e.responseJSON.errors;
        ajaxStop();

        if(errors.name) {
          $('#inputCategory').addClass('is-invalid');
          $('#inputCategoryError').removeClass('d-none');
          $('#inputCategoryError').html(errors.name[0]);
        }
        if(errors.slug) {
          $('#inputSlug').addClass('is-invalid');
          $('#inputSlugError').removeClass('d-none');
          $('#inputSlugError').html(errors.slug[0]);
        }
      }
    });
  })

  // Clear validasi error 
  $('#modalCategory').on('hide.bs.modal', function () {
    if($('#inputCategory')) {
      $('#inputCategory').removeClass('is-invalid');
      $('#inputCategoryError').addClass('d-none');
      $('#inputCategoryError').html('');
    }

    if($('#inputCategory')) {
      $('#inputSlug').removeClass('is-invalid');
      $('#inputCategoryError').addClass('d-none');
      $('#inputSlugError').html('');
    }
  })

  // Proses Destroy 
  $('body').on('click', '#btn-delete', function(e) {
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
            url: 'category/' + id,
            type: 'DELETE',
            success: function() {
              ajaxStop();

              Swal.fire(
                'Berhasil!',
                'Kategori berhasil dihapus!',
                'success'
              )

              $('#table_category').DataTable().ajax.reload();
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
  })
</script>