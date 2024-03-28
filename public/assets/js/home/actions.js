// Proses logout
$('body').on('click', '#btn-logout', function (e) {
  loadingTrue();
  $.ajax({
    url: 'logout',
    type: 'POST',
    success: function () {
      loadingFalse();
      window.location.reload();
    },
    error: function () {
      showError();
    }
  });
});



// Cart action start //
// Proses add to cart pada list menu
$('body').on('click', '#btn_add_cart', function () {
  var data = {
    food_id: $(this).data('food-id'),
    user_id: $(this).data('user-id'),
    price: $(this).data('price'),
  }

  loadingTrue();
  $.ajax({
    url: myApp + '/cart/add',
    method: 'POST',
    data: data,
    success: function (res) {
      loadingFalse();
      renderCart();
      alertSuccess(res.message);
    },
    error: function () {
      showError();
    }
  });
});

// Proses increment item pada cart
$('body').on('click', '#btn_increment', function () {
  var siblingInputQuantity = $(this).siblings('.input-quantity');
  var foodId = siblingInputQuantity.data('food-id');
  var userId = siblingInputQuantity.data('user-id');
  var quantity = parseInt(siblingInputQuantity.val()) + 1;
  siblingInputQuantity.val(quantity);

  var data = {
    food_id: foodId,
    user_id: userId,
  }

  disabledCheckbox($(this));
  undisabledCheckbox($(this));

  $.ajax({
    url: myApp + '/cart/add',
    method: 'POST',
    data: data,
    success: function () {
      iziToastSuccess('Item berhasil ditambah');
    },
    error: function () {
      showError();
    }
  });
});

// Proses decrement item pada cart
$('body').on('click', '#btn_decrement', function () {
  var siblingInputQuantity = $(this).siblings('.input-quantity');
  var foodId = siblingInputQuantity.data('food-id');
  var userId = siblingInputQuantity.data('user-id');
  var quantity = (siblingInputQuantity.val() != '0') ? parseInt(siblingInputQuantity.val()) - 1 : siblingInputQuantity.val();
  siblingInputQuantity.val(quantity)

  var data = {
    food_id: foodId,
    user_id: userId,
  }

  disabledCheckbox($(this));
  undisabledCheckbox($(this));

  $.ajax({
    url: myApp + '/cart/reduce',
    method: 'POST',
    data: data,
    success: function (res) {
      iziToastSuccess('Item berhasil dikurangi');

      if (res.message == 'Item berhasil dihapus') {
        renderCart();
      }
    },
    error: function () {
      showError();
    }
  });
});
// Cart action end //



// Actions online order start //
// Proses checkout pada online order start
$('body').on('click', '#btn-checkout', function () {

  // Cek apakah ada item yang di checked
  var items = $('.checkCart');
  var checked = [];
  var reservationId = '';
  var tableId = '';
  items.each(function () {
    checked += $(this).prop('checked');
  })

  loadingTrue();

  // Jika ada nilai true, lakukan proses checkout
  if (checked.includes(true)) {

    // Untuk order pada reservasi
    if ($('#reservation-id')) {
      reservationId = $('#reservation-id').data('reservation-id');
    }

    // Untuk offline order - checkout
    if ($('#table-id')) {
      tableId = $('#table-id').data('table-id');
    }

    var items = $('.checkCart');
    var cartItems = [];

    // ambil item checked
    items.each(function () {
      // jika checked true
      if ($(this).prop('checked') == true) {
        var cart_id = $(this).data('cart-id');

        cartItems.push(cart_id);
      }
    })

    if (reservationId) {
      // Untuk order pada halaman reservasi
      // Proses checkout
      $.ajax({
        url: myApp + '/checkout?reservation_id=' + reservationId,
        method: 'POST',
        data: {
          cart_items: cartItems
        },
        success: function (res) {
          loadingFalse();
          $('.body-order').html(res.html);
          setTotal();
          $('#modalOrder').modal('show');
        },
        error: function () {
          showError();
        }
      });
    } else if (tableId) {
      $.ajax({
        url: myApp + '/order/offline/checkout',
        method: 'POST',
        data: {
          cart_items: cartItems,
          table_id: tableId,
        },
        success: function (res) {
          loadingFalse();
          $('.body-checkout').html(res);
          setTotal();
          $('#modalCheckout').modal('show');
        },
        error: function () {
          showError();
        }
      });
    } else {
      // Untuk order pada halaman home
      // Cek apakah ada checkout yang belum diselesaikan
      $.ajax({
        url: myApp + '/order/checkout',
        method: 'GET',
        success: function (res) {

          // Cek apakah ada item checkout
          if (res.data.length == 0) {
            var items = $('.checkCart');
            var cartItems = [];

            // ambil item checked
            items.each(function () {
              // jika checked true
              if ($(this).prop('checked') == true) {
                var cart_id = $(this).data('cart-id');

                cartItems.push(cart_id);
              }
            })

            // Proses checkout
            $.ajax({
              url: myApp + '/checkout',
              method: 'POST',
              data: {
                cart_items: cartItems
              },
              success: function () {
                loadingFalse();
                window.location.href = '/checkout';
              },
              error: function () {
                showError();
              }
            });
          } else {
            // Jika checkout sebelumnya belum selesai
            loadingFalse();
            alertErrorWithConfirmToLocation('Tolong selesaikan checkout terlebih dahulu!', '/checkout');
          }
        },
        error: function () {
          showError();
        }
      });
    }
  } else {
    loadingFalse();
    // Jika tidak ada
    alertError('Tolong pilih item menu!');
  }
});
// Proses checkout pada online order end

// Proses batal pada halaman checkout - rollback checkout start
$('body').on('click', '#btn-cancel-order', function (e) {
  e.preventDefault();
  var checkoutItems = $('.checkout-item');
  var cartItemsId = [];
  checkoutItems.each(function () {
    cartItemsId.push($(this).data('id'));
  });

  loadingTrue();
  $.ajax({
    url: myApp + '/rollback/checkout',
    method: 'POST',
    data: {
      cart_items: cartItemsId,
    },
    success: function () {
      loadingFalse();
      window.location.href = '/';
    },
    error: function () {
      loadingFalse();
      showError();
    }
  });
});
// Proses batal pada halaman checkout - rollback checkout end

// Proses order online start 
$('body').on('submit', '#form-order', function (e) {
  e.preventDefault();

  var checkoutItems = $('.checkout-item');
  var itemsId = [];
  checkoutItems.each(function () {
    itemsId.push($(this).data('id'));
  });

  // Recipient name and phone
  var name = ($('#recipient_name').val() != '') ? $('#recipient_name').val() : $('#name').val();
  var phone = ($('#recipient_phone').val() != '') ? $('#recipient_phone').val() : $('#phone').val();

  // Address
  var address = ($('#address').val() != '') ? $('#address').val() : '';

  var data = {
    address: address,
    name: name,
    phone: phone,
    pick_up_date: $('#pick_up_date').val(),
    pick_up_time: $('#pick_up_time').val(),
    estimation_time: $('#select-estimation').val(),
    message: $('#message').val(),
    total: $('.total').html().replace(/\D/g, ""),
    payment_method: $('#select-method').val(),
    order_items_id: itemsId,
  }

  loadingTrue();
  $.ajax({
    url: myApp + '/order/online',
    method: 'POST',
    data: {
      order: data,
    },
    success: function () {
      loadingFalse();
      alertSuccessWithConfirmToLocation('Pesanan anda berhasil dibuat', '/orders');
    },
    error: function () {
      showError();
    }
  });
});
// Proses order online end 

// Proses batalkan online order start 
$('body').on('click', '.btn-denied', function () {
  var id = $(this).data('id');

  Swal.fire({
    title: 'Apakah anda yakin, membatalkan pesanan ini?',
    text: "Status pesanan ini tidak dapat dikembalikan lagi!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Ya, batalkan',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Tidak',
  }).then((result) => {
    if (result.isConfirmed) {

      loadingTrue();
      $.ajax({
        url: myApp + '/order/online/cancel/' + id,
        method: 'PUT',
        success: function () {

          loadingFalse();
          alertSuccessWithConfirmToLocation('Pesanan anda berhasil dibatalkan', window.location.href);
        },
        error: function () {
          showError();
        }
      });
    }
  })
})
// Proses batalkan online order end 

// Proses terima online order start 
$('body').on('click', '.btn-accept', function () {

  var id = $(this).data('id');

  Swal.fire({
    title: 'Apakah anda yakin, sudah menerima pesanan ini?',
    text: "Status pesanan ini tidak dapat dikembalikan lagi!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Ya, terima',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Tidak',
  }).then((result) => {
    if (result.isConfirmed) {

      loadingTrue();
      $.ajax({
        url: myApp + '/order/online/accept/' + id,
        method: 'PUT',
        success: function () {

          loadingFalse();
          alertSuccessWithConfirmToLocation('Pesanan anda berhasil diterima', window.location.href);
        },
        error: function () {
          showError();
        }
      });
    }
  })
})
// Proses terima online order end 

// Proses reservasi pada online order start 
$('body').on('click', '.btn-reservation', function () {

  var orderId = $(this).data('order-id');

  loadingTrue();
  $.ajax({
    url: myApp + '/order/online/reservation?online_order_id=' + orderId,
    method: 'GET',
    success: function (res) {
      loadingFalse();

      $('#modalReservation').modal('show');
      $('.body-reservation').html(res.html);
    },
    error: function (e) {
      loadingFalse();
      showError();
    }
  });
});
// Proses reservasi pada online order end 
// Actions online order end //



// Proses bayar - midtrans start //
$('body').on('click', '.btn-pay', function () {
  var snap_token = $(this).data('snap-token');

  window.snap.pay(snap_token, {
    onSuccess: function () {
      window.location.href = window.location.href;
    },
  })
});
// Proses bayar - midtrans end //



// Actions reservation online start //
// Proses input book reservation online start
$('body').on('submit', '#reservation_form', function (e) {
  e.preventDefault();

  var data = {
    username: $('#username').val(),
    name: $('#name').val(),
    phone: $('#phone').val(),
    estimation_time: $('#selectEstimation').val(),
    reservation_date: $('#reservation_date').val(),
    reservation_time: $('#reservation_time').val(),
  }

  loadingTrue();
  $.ajax({
    url: myApp + '/reservation/online/modal/checkout',
    method: 'POST',
    data: data,
    success: function (res) {
      loadingFalse();

      $('#modalReservation').modal('show');
      $('.body-reservation').html(res.html);
    },
    error: function (e) {
      loadingFalse();
      showError();
    }
  });
});
// Proses input book reservation online end

// Proses reservasi online pada reservasi dan order (checkout) start
$('body').on('submit', '#form-reservation', function (e) {
  e.preventDefault();

  var tables = $('input[name="check_table"]:checked');
  var tables_id = [];
  var order_id = '';
  tables.each(function () {
    tables_id.push($(this).val());
  });

  if (tables_id.length != 0) {
    // Cek apakah form pada reservasi atau form pada order
    if ($(this).data('name')) {
      // form pada order
      var name = $(this).data('name');
      var phone = $(this).data('phone');
      var reservation_date = $(this).data('date');
      var reservation_time = $(this).data('time');
      var estimation_time = $(this).data('estimation');
      order_id = $(this).data('order-id');
    } else {
      // form pada reservasi
      var name = ($('#recipient_name').val()) ? $('#recipient_name').val() : $('#input_name').val();
      var phone = ($('#recipient_phone').val()) ? $('#recipient_phone').val() : $('#input_phone').val();
      var reservation_date = $('#input_reservation_date').val();
      var reservation_time = $('#input_reservation_time').val();
      var estimation_time = $('#input_select_estimation').val();
    }

    loadingTrue();
    $.ajax({
      url: myApp + '/reservation/online/reservation',
      method: 'POST',
      data: {
        tables_id: tables_id,
        name: name,
        phone: phone,
        reservation_date: reservation_date,
        reservation_time: reservation_time,
        estimation_time: estimation_time,
        order_id: order_id,
      },
      success: function () {
        loadingFalse();
        $('#modalReservation').modal('hide');

        Swal.fire({
          title: 'Berhasil',
          text: 'Reservasi berhasil dibuat',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Tutup',
        }).then((result) => {
          if (result.isConfirmed) {
            if (order_id == '') {
              // proses pada form reservasi
              window.location.href = myApp + '/reservation';
            } else {
              // proses pada form order
              window.location.href = window.location.href;
            }
          }
        });
      },
      error: function () {
        showError();
      }
    });
  } else {
    alertError('Meja lupa dipilih!');
  }
});
// Proses reservasi online pada reservasi dan order end

// Proses accept reservation start
$('body').on('click', '.btn-accept-reservation', function () {
  var id = $(this).data('id');

  Swal.fire({
    title: 'Apakah anda yakin, reservasi ini sudah selesai?',
    text: "Status reservasi ini tidak dapat dikembalikan lagi!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Ya, selesai',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Tidak',
  }).then((result) => {
    if (result.isConfirmed) {

      loadingTrue();
      $.ajax({
        url: myApp + '/reservation/online/accept/' + id,
        method: 'PUT',
        success: function (res) {

          loadingFalse();
          if (res.status == 'Gagal') {
            alertError(res.message);
          } else {
            alertSuccessWithConfirmToLocation('Reservasi anda berhasil diselesaikan', window.location.href);
          }
        },
        error: function () {
          showError();
        }
      });
    }
  })
})
// Proses accept reservation end

// Proses cancel reservation start
$('body').on('click', '.btn-denied-reservation', function () {
  var id = $(this).data('id');

  Swal.fire({
    title: 'Apakah anda yakin, membatalkan reservasi ini?',
    text: "Status reservasi ini tidak dapat dikembalikan lagi!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Ya, batalkan',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Tidak',
  }).then((result) => {
    if (result.isConfirmed) {

      loadingTrue();
      $.ajax({
        url: myApp + '/reservation/online/cancel/' + id,
        method: 'PUT',
        success: function () {

          loadingFalse();
          alertSuccessWithConfirmToLocation('Reservasi anda berhasil dibatalkan', window.location.href);
        },
        error: function () {
          showError();
        }
      });
    }
  })
})
// Proses cancel reservation end
// Actions reservation online end //



// proses order online pada reservasi start //
$('body').on('submit', '#form-checkout-order-reservation', function (e) {
  e.preventDefault();

  loadingTrue();
  var items = $('.item-row');
  var items_id = [];
  var total = $('.total').html().replace(/\D/g, "");

  items.each(function () {
    items_id.push($(this).data('cart-id'));
  });

  $.ajax({
    url: myApp + '/reservation/online/order',
    method: 'POST',
    data: {
      reservation_id: $('#reservation-id').data('reservation-id'),
      order: {
        payment_method: $('#select-method').val(),
        message: $('#message').val(),
        total: total,
        order_items_id: items_id,
      },
    },
    success: function () {
      loadingFalse();
      alertSuccessWithConfirmToLocation('Pesanan anda berhasil dibuat', '/reservation');
    },
    error: function () {
      showError();
    }
  });
});
// proses order online pada reservasi end //



// Actions offline order start //
// Proses offline order start
$('body').on('submit', '#form-checkout', function (e) {
  e.preventDefault();

  loadingTrue();
  var items = $('.item-row');
  var items_id = [];
  var total = $('.total').html().replace(/\D/g, "");
  var name = $('#name').val();
  var table_id = $('#table-id').data('table-id');

  items.each(function () {
    items_id.push($(this).data('cart-id'));
  });

  $.ajax({
    url: myApp + '/order/offline/order',
    method: 'POST',
    data: {
      items_id: items_id,
      total: total,
      name: name,
      table_id: table_id,
    },
    success: function () {
      loadingFalse();
      alertSuccessWithConfirmToLocation('Pesanan anda berhasil dibuat', window.location.href);
    },
    error: function () {
      showError();
    }
  });
});
// Proses offline order end

// Proses menampilkan modal order baru-baru ini pada halaman offline order start
$('body').on('click', '.btn-my-order', function () {
  var id = $('#table-id').data('table-id')

  loadingTrue();
  $.ajax({
    url: myApp + '/order/offline/order/' + id,
    method: 'GET',
    success: function (res) {

      loadingFalse();
      $('.body-order').html(res);
      setTotalOrder();
      $('#modalOrder').modal('show');
    },
    error: function (e) {
      loadingFalse();
      showError();
    }
  });
})
// Proses menampilkan modal order baru-baru ini pada halaman offline order end

// Proses selesai atau tutup order dan render ulang modal order start
$('body').on('click', '.btn-order-done', function () {
  var orderid = $(this).data('order-id');

  loadingTrue();
  loadingTrue2();
  $.ajax({
    url: myApp + '/order/offline/order/close/' + orderid,
    method: 'GET',
    success: function (res) {

      loadingFalse();
      loadingFalse2();
      Swal.fire({
        title: 'Berhasil',
        icon: 'success',
        text: 'Pesanan selesai',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Tutup',
      }).then((result) => {
        if (result.isConfirmed) {
          $('.body-order').html(res);
          setTotalOrder();
        }
      });
    },
    error: function (e) {
      loadingFalse();
      loadingFalse2();
      showError();
    }
  });
});
// Proses selesai atau tutup order dan render ulang modal order end
// Actions offline order end //



// Actions offline reservation start //
// Proses reservation start 
$('body').on('submit', '#off-reservation-form', function (e) {
  e.preventDefault();
  var name = $('#name').val();

  loadingTrue();
  $.ajax({
    url: myApp + '/reservation/offline',
    method: 'POST',
    data: {
      name: name,
    },
    success: function (res) {
      loadingFalse();

      Swal.fire({
        title: 'Berhasil',
        icon: 'success',
        html:
          'Nomor Reservasi : <br/><b><i>' + res.data.reservation_id +
          '</b></i><br/><br/>' + 'Reservasi anda berhasil dibuat, mohon untuk screenshot tampilan ini!',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Tutup',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = window.location.href;
        }
      });
    },
    error: function () {
      showError();
    }
  });
});
// Proses reservation end 
// Actions offline reservation end //



// Action navigasi pada halaman orders - online order start //
$(document).ready(function () {
  $('.order-list-item').on('click', function () {
    var link = $(this)[0];

    loadingTrue();
    $.ajax({
      url: myApp + '/orders',
      data: {
        status: $(this).data('status'),
      },
      success: function (res) {
        loadingFalse();
        clearActive()
        link.classList.add('active');

        $('.container-items').html(res);
      }
    });
  });

  // Fungsi bersihkan semua kelas active pada element links
  function clearActive() {
    var links = $('.order-list-item');

    links.each(function () {
      $(this)[0].classList.remove('active');
    });
  }
});
// Action navigasi pada halaman orders - online order end //



// Action navigasi pada halaman reservation - online reservation start //
$(document).ready(function () {
  $('.reservation-list-item').on('click', function () {
    var link = $(this)[0];

    loadingTrue();
    $.ajax({
      url: myApp + '/reservation',
      data: {
        status: $(this).data('status'),
      },
      success: function (res) {
        loadingFalse();
        clearActive()
        link.classList.add('active');

        $('.container-items').html(res);
      }
    });
  });

  // Fungsi bersihkan semua kelas active pada element links
  function clearActive() {
    var links = $('.reservation-list-item');

    links.each(function () {
      $(this)[0].classList.remove('active');
    });
  }
});
// Action navigasi pada halaman reservation - online reservation end //



// Action ubah total pada halaman checkout online order start //
$(document).ready(function () {
  setTotal();
});
// Action ubah total pada halaman checkout online order end //



// Action untuk ubah quantity pada cart item ketika input quantity berubah value nya start //
$('body').on('change', '.input-quantity', function () {
  var foodId = $(this).data('food-id');
  var userId = $(this).data('user-id');
  var quantity = $(this).val();

  disabledCheckbox($(this));
  undisabledCheckbox($(this));

  var data = {
    food_id: foodId,
    user_id: userId,
    quantity: quantity,
  }

  $.ajax({
    url: myApp + '/cart/add',
    method: 'POST',
    data: data,
    success: function () {
      iziToastSuccess('Item berhasil diubah');
    },
    error: function () {
      showError();
    }
  });
});
// Action untuk ubah quantity pada cart item ketika input quantity berubah value nya end //


// Action cetak bukti pembayaran start
$('body').on('click', '.btn-payment', function (e) {
  var order_id = $(this).data('id');

  var newURL = 'order/payment/' + order_id.toLowerCase();
  window.open(newURL, '_blank');
});
// Action cetak bukti pembayaran end


// Action cetak bukti pembayaran offline start
$('body').on('click', '.btn-payment-offline', function (e) {
  var order_id = $(this).data('id');

  var newURL = myApp + '/offline/order/payment/' + order_id.toLowerCase();
  window.open(newURL, '_blank');
});
// Action cetak bukti pembayaran end