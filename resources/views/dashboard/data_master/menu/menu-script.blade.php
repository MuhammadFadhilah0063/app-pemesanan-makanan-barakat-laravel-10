<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_menu').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      colReorder: true,
      language: language, // from config
      ajax: {
        'url': '{{ url()->current() }}',
        'data': function (data) { 
          data.filter = getFilter();
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
        { data: 'name', },
        { data: 'category.name',},
        { 
          data: 'price', 
          render: function (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              return new Intl.NumberFormat('id-ID').format(data);
          } 
        },
        { 
          data: 'ready_btn',
          orderable: false, 
          searchable: false,
        },
        { 
          data: 'image',
          orderable: false, 
          searchable: false 
        },
        { 
          data: 'actions', 
          name: "actions",
          orderable: false, 
          searchable: false 
        },
      ],
      columnDefs: [
        { targets: 0, width: '1%', className: "text-lg-center align-middle text-capitalize" },
        { targets: 1, width: '30%', className: "align-middle"},
        { targets: [2, 3], className: "align-middle" },
        {
          targets: [4, 5],
          className: "text-lg-center align-middle text-capitalize"
        },
        {
          targets: 6,
          width: '10%',
          className: "text-lg-center align-middle text-capitalize text-nowrap"
        },
      ]
    });
  });

  // Ambil Filter
  function getFilter() {
    if ($('.filter-select').val()) {
      return $('.filter-select').val();
    }else {
      return '';
    }
  }

  // Fungsi pilih filter
  $('#filter').on('change', function (e) {
    if(this.value == 'status') {
      // Mematikan onChange
      $('#filterCategory').off('change');

      // Menambahkan innerHTML
      $('.filter-select').html(
        '<option value="select">Pilih status</option><option value="0-ready">Habis</option><option value="1-ready">Ada</option>'
      );

      // Menambahkan attr id
      $('.filter-select').attr('id', 'filterStatus');

      // Menambahkan prop disabled
      $('.filter-select').prop('disabled', false);

      $('#filterStatus').on('change', function () {
        reloadTable('#table_menu')
      });
    }else if(this.value == 'category') {
      $('#filterStatus').off('change');
      
      // template dengan foreeach
      var html = '<option value="select">Pilih kategori</option>';
      @foreach ($categories as $category)
      html += '<option value="{{ $category->id }}-category_id">{{ $category->name }}</option>';
      @endforeach
      
      $('.filter-select').html(html);
      $('.filter-select').attr('id', 'filterCategory');
      $('.filter-select').prop('disabled', false);
      
      $('#filterCategory').on('change', function () {
        reloadTable('#table_menu')
      });
    }else {
      $('.filter-select').val('')
      $('.filter-select').attr('id', 'filterEmpty');
      $('.filter-select').html('');
      $('.filter-select').prop('disabled', true);

      reloadTable('#table_menu')
    }
  })

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
  $('#inputName').on('input', function() {
    var category = $(this).val();
    var slug = category.trim().toLowerCase().replace(/\s+/g, '-');
    $('#inputSlug').val(slug);
  });

  // Button edit 
  $('body').on('click', '#btn-edit', function(e) {
    ajaxStart();
    let id = $(this).data('id');

    $.ajax({
      url: 'menu/' + id + '/edit',
      type: 'GET',
      success: function(response) {
        ajaxStop();
        $('#textareaDescription').val('');
        $('#inputName').val(response.data.name);
        $('#inputSlug').val(response.data.slug);
        $('#selectCategory').val(response.data.category_id);
        $('#inputPrice').val(response.data.price);
        if(response.data.description) {
          $('#textareaDescription').val(response.data.description);
        }
        $('#inputId').val(id);

        // image
        // Ekstrak nama file dari URL
        var imageUrl = response.data.image;
        var fileName = imageUrl.substring(imageUrl.lastIndexOf('/') + 1);
        $('.custom-file-label').addClass('selected').html(fileName);
        $('#previewImage').attr('src', imageUrl);

        $('#exampleModalCenterTitle').html('Ubah Menu');
        $('#submit').html('Ubah');
        
        $('#modalMenu').modal('show');
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
    $('#inputName').val('');
    $('#inputSlug').val('');
    $('#inputPrice').val('');
    $('#selectCategory').val('');
    $('#inputId').val('');
    $('#textareaDescription').val('');

    // Kosongkan file input
    var fileInput = $('#inputFile');
    fileInput.val(null);
    fileInput.next('.custom-file-label').html('Pilih file');

    // Set kembali ke image default
    $('#previewImage').attr('src', "{{ asset('storage/image/app/img.png')}}").show();

    $('#exampleModalCenterTitle').html('Tambah Menu');
    $('#submit').html('Tambah');
    
    $('#modalMenu').modal('show');
  });

  // Proses update or store
  $(document).ready(function () {
    $('#formData').submit(function (e) {
      ajaxStart();
      e.preventDefault();
      clearError();

      var name = $('#inputName').val();
      var slug = $('#inputSlug').val();
      var category_id = $('#selectCategory').val();
      var price = parseInt($('#inputPrice').val().replace(/\./g, ''));
      var description = $('#textareaDescription').val();

      // File gambar
      var fileInput = document.getElementById('inputFile');
      var image = fileInput.files[0];

      // FormData
      var formData = new FormData();
      if(image != undefined) {
        formData.append('image', image);
      }
      formData.append('name', name);
      formData.append('slug', slug);
      formData.append('category_id', category_id);
      formData.append('price', price);
      formData.append('description', description);

      if(!$('#inputId').val()) {
        // Proses store
        var url = 'menu';
      }else {
        // Proses update
        var id = $('#inputId').val();
        var url = 'menu/' + id;
        formData.append('_method', 'PUT');
      }

      $.ajax({
        url: url,
        processData: false,
        contentType: false,
        method: 'POST',
        data: formData,
        enctype: 'multipart/form-data',
        success: function(response) {
          ajaxStop();
          Swal.fire({
            title: 'Berhasil',
            text: (url == 'menu' ? 'Menu baru berhasil ditambahkan!' : 'Menu berhasil diubah!'),
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Tutup',
          })
          $('#modalMenu').modal('hide');
          reloadTable('#table_menu')
        },
        error: function(e) {
          console.clear();
          errors = e.responseJSON.errors;
          ajaxStop();

          // Menampilkan error
          if(errors.slug) {
            $('#inputSlug').addClass('is-invalid');
            $('#inputSlugError').removeClass('d-none');
            $('#inputSlugError').html(errors.slug[0]);
          }
          if(errors.price) {
            $('#inputPrice').addClass('is-invalid');
            $('#inputPriceError').removeClass('d-none');
            $('#inputPriceError').html(errors.price[0]);
          }
          if(errors.image) {
            $('#inputFile').addClass('is-invalid');
            $('#inputFileError').removeClass('d-none');

            // template dengan foreeach
            var errorsImage = errors.image;
            var html;
            errorsImage.forEach(function(item, index) {
              if(index == 0) {
                html = `<span class="d-block mb-1">${item}</span>`;
              }else {
                html += `<span class="d-block mb-1">${item}</span>`;
              }
            });
            
            $('#inputFileError').html(html);
          }
        }
      });
    })
  })

  // Clear validasi error ketika modal ditutup
  $('#modalMenu').on('hide.bs.modal', function () {
    clearError();
  })

  // fungsi clear error
  function clearError() {
    if($('#inputSlug')) {
      $('#inputSlug').removeClass('is-invalid');
      $('#inputSlugError').addClass('d-none');
      $('#inputSlugError').html('');
    }

    if($('#inputPrice')) {
      $('#inputPrice').removeClass('is-invalid');
      $('#inputPriceError').addClass('d-none');
      $('#inputPriceError').html('');
    }

    if($('#inputFile')) {
      $('#inputFile').removeClass('is-invalid');
      $('#inputFileError').addClass('d-none');
      $('#inputFileError').html('');
    }
  }

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
            url: 'menu/' + id,
            type: 'DELETE',
            success: function() {
              ajaxStop();

              Swal.fire(
                'Berhasil!',
                'Menu berhasil dihapus!',
                'success'
              )

              $('#table_menu').DataTable().ajax.reload();
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

  // Input file
  $(document).ready(function() {
    $('#inputFile').on('change', function(event) {
      var fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass('selected').html(fileName);
    });
  });

  // Image prewiew
  $('#inputFile').on('change', function() {
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#previewImage').attr('src', e.target.result).show();
    }

    reader.readAsDataURL(file);
  });

  // Fungsi format input harga
  $(document).ready(function() {
    // Ambil input harga
    const inputHarga = $('#inputPrice');

    // Event saat pengguna memasukkan angka
    inputHarga.on('input', function() {
      // Ambil nilai input harga
      const nilaiHarga = $(this).val();

      // Hilangkan karakter selain angka
      const angkaHarga = nilaiHarga.replace(/\D/g, '');

      // Format angka menjadi format rupiah
      const hargaFormatted = formatRupiah(angkaHarga);

      // Tampilkan format rupiah pada input
      $(this).val(hargaFormatted);
    });

    // Fungsi untuk memformat angka menjadi format rupiah
    function formatRupiah(angka) {
      const reverse = angka.toString().split('').reverse().join('');
      const ribuan = reverse.match(/\d{1,3}/g);
      const rupiah = ribuan.join('.').split('').reverse().join('');
      return rupiah;
    }
  });

  // Proses ubah status menu
  $('body').on('click', '#btn-ready', function (e) {
    ajaxStart();
    var id = $(this).data('id');
    var ready = $(this).data('ready');
    
    $.ajax({
      url: 'menu/update-ready/' + id,
      method: 'POST',
      data: {
        '_method': 'PUT',
        'ready': ready
      },
      success: function(response) {
        ajaxStop();
        reloadTable('#table_menu');
        Swal.fire({
          title: 'Berhasil',
          text: response.message,
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Tutup',
        })        
      },
      error: function (err) {
        ajaxStop();
        console.log(err.responseJSON.errors)
      }
    })
  })

</script>