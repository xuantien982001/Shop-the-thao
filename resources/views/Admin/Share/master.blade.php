<!DOCTYPE html>
<html lang="en">
  <head>
      @include('Admin.share.head')
  </head>
  <body>
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      @include('Admin.share.top')
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('Admin.share.menu')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
            <div class="container-fluid">
                @yield('title')
            </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
              @yield('content')
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
            @include('Admin.share.footer')
        </footer>
      </div>
    </div>
    @include('Admin.share.js')
    <script src="/js/app.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></scrip> --}}
    @yield('js')
  </body>
</html>
