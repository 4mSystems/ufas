<!-- start: HEAD -->

@include('layouts.header')
<!-- end: HEAD -->
  
<!-- start: PAGESLIDE LEFT -->
@include('layouts.navbar')
<!-- end: PAGESLIDE LEFT -->

<!-- start: MAIN CONTAINER -->
@yield('content')

@include('layouts.errors')

<!-- end: MAIN CONTAINER -->
@include('layouts.footer')
