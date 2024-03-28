<script>
  // Button cetak
  $('body').on('click', '.btn-print', function (e) {
    e.preventDefault();
    var month = $('#report_month').val();
    var year = $('#report_year').val();

    var newURL = 'profit-and-loss/export?year=' + year + '&month=' + month;
    window.open(newURL, '_blank');
  });
</script>