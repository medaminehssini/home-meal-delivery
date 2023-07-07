	<!-- start: MAIN JAVASCRIPTS -->
    <script src="{{ url('vendor/jquery/jquery.min.js', []) }}"></script>
    <script src="{{ url('vendor/bootstrap/js/bootstrap.min.js', []) }}"></script>
    <script src="{{ url('vendor/modernizr/modernizr.js', []) }}"></script>
    <script src="{{ url('vendor/jquery-cookie/jquery.cookie.js', []) }}"></script>
    <script src="{{ url('vendor/perfect-scrollbar/perfect-scrollbar.min.js', []) }}"></script>
    <script src="{{ url('vendor/switchery/switchery.min.js', []) }}"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="{{ url('vendor/Chart.js/Chart.min.js', []) }}"></script>
    <script src="{{ url('vendor/jquery.sparkline/jquery.sparkline.min.js', []) }}"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="{{ url('vendor/bootstrap-fileinput/jasny-bootstrap.js', []) }}"></script>

    <!-- start: JavaScript Event Handlers for this page -->
    <script src="{{ url('assets/js/index.js', []) }}"></script>

    <script src="{{ url('vendor/sweetalert/sweet-alert.min.js', []) }}"></script>
    <script src="{{ url('vendor/toastr/toastr.min.js', []) }}"></script>
    <script src="{{ url('vendor/DataTables/jquery.dataTables.min.js', []) }}"></script>
    <script src="{{ url('assets/js/table-data.js', []) }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0bbh9FJxy1aQ4BF5M8BiyyLFbzvtZX0A"></script>

    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="{{ url('assets/js/main.js', []) }}"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Index.init();
        });
    </script>
    
    @if (session('error'))
    <div id="errrorToastr" style="display: none">
        {{ session('error') }}
    </div>
        <script>
            var ff = document.getElementById('errrorToastr').innerHTML;
            toastr.options = {
                "closeButton": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
                toastr.error( ff )

        </script>
    @endif
    @if (session('warning'))
    <div id="errrorToastr" style="display: none">
        {{ session('warning') }}
    </div>
        <script>
            var ff = document.getElementById('errrorToastr').innerHTML;
            toastr.options = {
                "closeButton": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
                toastr.warning( ff )

        </script>
    @endif
    @if (session('success'))
    <div id="successToastr" style="display: none">
        {{ session('success') }}
    </div>
        <script>
            var ff = document.getElementById('successToastr').innerHTML;
            toastr.options = {
                "closeButton": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
                toastr.success( ff )

        </script>
    @endif

