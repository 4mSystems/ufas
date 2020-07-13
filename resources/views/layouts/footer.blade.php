<div style="padding:45px">


</div>


<style>
#footer {
position:absolute;
bottom:0;
}
</style>
@if(session('lang')=='ar')
    <footer id="footer" class="footer footer-  " >
        <br>
      <p  class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2020 <a href="#" target="_blank" class="text-bold-800 grey darken-2">Uram IT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block"> </span></p>
    </footer>
    @else
    <footer id="footer" class="footer footer-  "  >
        <br>
        <p  class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2020 <a href="#" target="_blank" class="text-bold-800 grey darken-2">Uram IT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block"> </span></p>
    </footer>
    @endif


</div>
    <!-- BEGIN VENDOR JS-->
    <script src="{{url('public/app-assets/js/core/libraries/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('public/app-assets/vendors/js/ui/tether.min.js')}}" type="text/javascript"></script>
    <script src="{{url('public/app-assets/js/core/libraries/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('public/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('public/app-assets/vendors/js/ui/unison.min.js')}}" type="text/javascript"></script>
    <script src="{{url('public/app-assets/vendors/js/ui/blockUI.min.js')}}" type="text/javascript"></script>
    <script src="{{url('public/app-assets/vendors/js/ui/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{url('public/app-assets/vendors/js/ui/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{url('public/app-assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{url('public/app-assets/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{url('public/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
    <script src="{{url('public/app-assets/js/core/app.js')}}" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->

    <script src="{{url('public/app-assets/js/scripts/pages/dashboard-lite.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  @stack('js')

  </body>

</html>
