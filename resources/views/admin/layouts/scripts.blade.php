<!-- Mainly scripts -->
<script src="{{asset('assets/admin/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('assets/admin/js/inspinia.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/pace/pace.min.js')}}"></script>

@stack('js')

<!-- GITTER -->
<script src="{{asset('assets/admin/js/plugins/gritter/jquery.gritter.min.js')}}"></script>

<!-- Sparkline -->
<script src="{{asset('assets/admin/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Sparkline demo data  -->
<script src="{{asset('assets/admin/js/demo/sparkline-demo.js')}}"></script>

<!-- Toastr -->
<script src="{{asset('assets/admin/js/plugins/toastr/toastr.min.js')}}"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    @if(Session::has('message'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('message') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('message') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
    @endif
</script>
