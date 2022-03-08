<script>
$(document).ready(function() {
    $('.loading').click(function() {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Loading...');
        $('button').addClass('disabled');
        $('a').addClass('disabled');
        $('input').addClass('disabled');
    });
   
    $('#navbar-search-main').on('submit', function() {
        $('button').addClass('disabled');
        $('a').addClass('disabled');
        $('input').addClass('disabled');
    });
    // $('.selectpicker').selectpicker();
});
</script>