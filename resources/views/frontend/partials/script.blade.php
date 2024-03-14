 <!-- Vendor JS Files -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->
<script src="{{ asset('lp/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/purecounter/purecounter.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('lp/assets/js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
// buscar dando click al botton
$('#btn-search').on('click', function(e) {
    e.preventDefault();

    var searchValue = $('#input-search').val();

    performSearch(searchValue);
});
// buscar al presionar enter en el input
$('#input-search').on('keypress', function(e) {
    if (e.which == 13) {  // 13 es el código de tecla para Enter
        e.preventDefault();

        var searchValue = $(this).val();

        performSearch(searchValue);
    }
});

// función para realizar la búsqueda
function performSearch(searchValue) {
    $.ajax({
        url: "{{ route('home.search') }}",
        method: 'POST',
        data: {
            search: searchValue,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            $('#div-search').html(response);

            $('html,body').animate({
                scrollTop: $("#div-search").offset().top
            }, 10);
        }
    });
}
</script>