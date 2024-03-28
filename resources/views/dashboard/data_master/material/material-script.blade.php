<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_material').DataTable({
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
        { data: 'name', },
        { 
          data: 'stock',
          searchable: false,
          render: function (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              return new Intl.NumberFormat('id-ID').format(data);
          }
        },
        { 
          data: 'unit',
          orderable: false,
          searchable: false,
        },
        { 
          data: 'actions', 
          orderable: false, 
          searchable: false   
        }
      ],
      columnDefs: [
        { targets: 0, width: '1%', className: "text-lg-center align-middle text-capitalize" },
        {
          targets: 1,
          className: "align-middle text-capitalize",
          width: '30%',
        },
        {
          targets: [2, 3],
          className: "text-lg-center align-middle text-capitalize"
        },
        {
          targets: 4,
          className: "align-middle text-lg-center text-capitalize",
          width: '30%',
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

  // Button edit 
  $('body').on('click', '#btn-edit', function(e) {
    ajaxStart();
    let id = $(this).data('id');

    $.ajax({
      url: 'material/' + id + '/edit',
      type: 'GET',
      success: function(response) {
        ajaxStop();
        $('#inputName').val(response.data.name);
        $('#inputStok').val(response.data.stock);
        $('#selectUnit').val(response.data.unit);
        $('#inputId').val(id);
        $('#exampleModalCenterTitle').html('Ubah Bahan Baku');
        $('#submit').html('Ubah');
        
        $('#modalMaterial').modal('show');
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
    $('#inputStok').val('');
    $('#selectUnit').val('');
    $('#inputId').val('');

    $('#exampleModalCenterTitle').html('Tambah Bahan Baku');
    $('#submit').html('Tambah');
    
    $('#modalMaterial').modal('show');
  });

  // Proses update or store
  $(document).ready(function () {
    $('#formData').submit(function (e) {
      ajaxStart();
      e.preventDefault();
      clearError();

      var name = $('#inputName').val();
      var stok = parseInt($('#inputStok').val().replace(/\./g, ''));
      var unit = $('#selectUnit').val();

      if(!$('#inputId').val()) {
        // Proses store
        var url = 'material';
        var method = 'POST';
      }else {
        // Proses update
        var id = $('#inputId').val();
        var url = 'material/' + id;
        var method = 'PUT';
      }

      $.ajax({
        url: url,
        method: method,
        data: {
          name: name,
          stock: stok,
          unit: unit,
        },
        success: function(response) {
          ajaxStop();
          Swal.fire({
            title: 'Berhasil',
            text: (url == 'material' ? 'Bahan baku baru berhasil ditambahkan!' : 'Bahan baku berhasil diubah!'),
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Tutup',
          })
          $('#modalMaterial').modal('hide');
          reloadTable('#table_material')
        },
        error: function(e) {
          console.clear();
          errors = e.responseJSON.errors;
          ajaxStop();

          // Menampilkan error
          if(errors.name) {
            $('#inputName').addClass('is-invalid');
            $('#inputNameError').removeClass('d-none');
            $('#inputNameError').html(errors.name[0]);
          }
          if(errors.stok) {
            $('#inputStok').addClass('is-invalid');
            $('#inputStokError').removeClass('d-none');
            $('#inputStokError').html(errors.stok[0]);
          }
          if(errors.unit) {
            $('#selectUnit').addClass('is-invalid');
            $('#selectUnitError').removeClass('d-none');
            $('#selectUnitError').html(errors.unit[0]);
          }
        }
      });
    })
  })

  // fungsi clear error
  function clearError() {
    if($('#inputName')) {
      $('#inputName').removeClass('is-invalid');
      $('#inputNameError').addClass('d-none');
      $('#inputNameError').html('');
    }

    if($('#inputStok')) {
      $('#inputStok').removeClass('is-invalid');
      $('#inputStokError').addClass('d-none');
      $('#inputStokError').html('');
    }

    if($('#selectUnit')) {
      $('#selectUnit').removeClass('is-invalid');
      $('#selectUnitError').addClass('d-none');
      $('#selectUnitError').html('');
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
            url: 'material/' + id,
            type: 'DELETE',
            success: function() {
              ajaxStop();

              Swal.fire(
                'Berhasil!',
                'Bahan baku berhasil dihapus!',
                'success'
              )

              $('#table_material').DataTable().ajax.reload();
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

  // Fungsi format input stok
  $(document).ready(function() {
    // Ambil input unit
    const inputUnit = $('#inputStok');

    // Event saat pengguna memasukkan angka
    inputUnit.on('input', function() {
      // Ambil nilai input Unit
      const nilaiUnit = $(this).val();

      // Hilangkan karakter selain angka
      const angkaUnit = nilaiUnit.replace(/\D/g, '');

      // Format angka menjadi format ribu
      const unitFormatted = formatUnit(angkaUnit);

      // Tampilkan format ribu pada input
      $(this).val(unitFormatted);
    });

    // Fungsi untuk memformat angka menjadi format ribu
    function formatUnit(angka) {
      const reverse = angka.toString().split('').reverse().join('');
      const ribuan = reverse.match(/\d{1,3}/g);
      const rupiah = ribuan.join('.').split('').reverse().join('');
      return rupiah;
    }
  });  
</script>