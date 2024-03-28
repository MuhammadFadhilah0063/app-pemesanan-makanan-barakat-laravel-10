<script>
  $(document).ready(function () {
    // Take hash # (fragment)
    var fragment = window.location.hash.substring(1);

    // Elements link
    var homeLink = $('#home_link');
    var aboutLink = $('#about_link');
    var menuLink = $('#menu_link');
    var reservationLink = $('#reservation_link');
    var contactLink = $('#contact_link');

    // Logic active link
    if (fragment == 'about') aboutLink[0].classList.add('active');
    else if (fragment == 'menu') menuLink[0].classList.add('active');
    else if (fragment == 'reservation') reservationLink[0].classList.add('active');
    else if (fragment == 'contact') contactLink[0].classList.add('active');
    else homeLink[0].classList.add('active');
        
    homeLink.on('click', function () {
      clearActive()
      homeLink[0].classList.add('active');
    })
    aboutLink.on('click', function () {
      clearActive()
      aboutLink[0].classList.add('active');
    })
    menuLink.on('click', function () {
      clearActive()
      menuLink[0].classList.add('active');
    })
    reservationLink.on('click', function () {
      clearActive()
      reservationLink[0].classList.add('active');
    })
    contactLink.on('click', function () {
      clearActive()
      contactLink[0].classList.add('active');
    })
      
    function clearActive() {
      homeLink[0].classList.remove('active');
      aboutLink[0].classList.remove('active');
      menuLink[0].classList.remove('active');
      reservationLink[0].classList.remove('active');
      contactLink[0].classList.remove('active');
    }
  });
</script>