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
    $(document).ready(function(){
        $('#btn-search').click(function(){
            let search = $('#input-search').val();
            if(search){
                $('#form-search input[name="search"]').val($('#input-search').val());
                window.location = './#div-search';
                $.post($('#form-search').attr('action'), $('#form-search').serialize(), function(res){
                    $('#div-search').html(res);
                });
            }
        });
    });
</script>