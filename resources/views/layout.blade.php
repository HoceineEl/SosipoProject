
@php
       use Illuminate\Support\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="{{ asset('images/sosipologo.png') }}">
  <title>
    Sosipo
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->

  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<style>
  main {
    min-height: 100vh; /* set minimum height to the viewport height */
  }
</style>

</head>

<body class="g-sidenav-show   bg-white-300">
    <div class="min-height-200 bg-success position-absolute w-100" style="background-image: url('{{ asset('images/img3.wallspic.com-triticale-agriculture-barley-food_grain-crop-2560x1600.jpg') }}')"></div>
        <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs  border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
            <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-10 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="#" target="_blank">
                <img src="{{ asset('images/sosipologo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Sosipo</span>
            </a>
            </div>
            <hr class="horizontal dark mt-0">
            <div class="collapse navbar-collapse " >
                    <ul class="navbar-nav">

                        @if( auth()->user()->role_id != '3')
                            <li class="nav-item mt-3">
                            <a class="nav-link btn btn btn-success text-light " href="{{ route('recette.show') }}">
                                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-up-arrow text-light text-lg"></i>
                                </div>
                                <span class="nav-link-text ms-2 mt-2">Recette</span>
                            </a>
                            <li class="nav-item mt-3">
                            <a class="nav-link  btn btn-success text-light  "  href="{{ route('depense.show') }}">
                                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-down-arrow text-light text-lg "></i>
                                </div>
                                <span class="nav-link-text ms-1 mt-2">Depense</span>
                            </a>
                            </li>
                            <li class="nav-item mt-3">
                            <a class="nav-link  btn btn-success text-light  "  href="{{ route('charts') }}">
                                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-dashboard text-light  text-lg"></i>
                                </div>
                                <span class="nav-link-text ms-1 mt-2">Dashboard</span>
                            </a>
                            </li>
                        @endif

                        <li class="nav-item mt-3">
                        <a class="nav-link  btn btn-success text-light "  href="{{ route('document.show') }}">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-filetype-doc text-light text-lg"></i>
                            </div>
                            <span class="nav-link-text ms-1 mt-2">Document</span>
                        </a>
                        </li>

                    </ul>
            </div>
        </aside>
        <main class="main-content position-relative ">
            <!-- Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
                <div class="container-fluid py-1 px-3">
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav ms-auto justify-content-end ">
                            @if(Auth::user()->role_id =="1")
                            <li class="nav-item dropdown text-dark pe-2 mx-3 d-flex align-items-center">
                                <a href="javascript:;"  class="nav-link text-light p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell-fill cursor-pointer" ></i>
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-end text-dark  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                    <li class="mb-2">
                                        <a class="dropdown-item text-dark border-radius-md" href="{{ route('approuve.depense.show') }}">
                                            <div class="d-flex py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">Depenses</span><strong class="badge text-danger">{{ DB::table('depenses')->where('approuve', false)->count()  }}</strong>
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                    @php
                                                                $depense = DB::table('depenses')->where('approuve',false)->first();
                                                                if($depense)
                                                                {
                                                                    $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $depense->created_at);
                                                                    $diff = $created_at->diffForHumans();
                                                                    echo $diff;
                                                                }else   echo '<p class="text-xs text-secondary mb-0">Tout les depenses sont approuvé.</p>'
                                                    @endphp
                                                </p>
                                            </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="{{ route('approuve.recette.show') }}">
                                            <div class="d-flex py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Recettes</span><strong class="badge text-danger ">{{ DB::table('depenses')->where('approuve', false)->count()  }}</strong>
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                    @php
                                                                $recette = DB::table('recettes')->where('approuve',false)->first();
                                                                if($recette)
                                                                {
                                                                    $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $recette->created_at);
                                                                    $diff = $created_at->diffForHumans();
                                                                    echo $diff;
                                                                }else   echo '<p class="text-xs text-secondary mb-0">Tout les recettes  sont approuvé.</p>'
                                                    @endphp
                                                </p>
                                            </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            <li class="nav-item d-flex  mx-3  align-items-center">
                                <img src="{{ asset('images/O4PjbczuLsSRp8XWvtUM18lbv2POPNXUZNvknpzy.png') }}" style="width:40px;height:40px" class="rounded-circle img-thumbnail" alt="{{ auth()->user()->name }}" title="{{ auth()->user()->name }}" data-toggle="tooltip" data-placement="top">
                            </li>
                            <li class="nav-item d-flex  mx-3  align-items-center">
                            <a href="{{ route('logout') }}" class="nav-link text-white font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign out</span>
                            </a>
                            </li>
                                <li class="nav-item d-lg-none ps-3  mx-3  d-flex align-items-center">
                                <a href="#" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                    <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    </div>
                                </a>
                                </li>
                            <li class="nav-item pe-3  mx-3  d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        {{-- Content Section  --}}
                            @if (session('success'))
                                <div class="col-5 mx-auto">
                                    <div class="alert alert-success d-flex text-light align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                                <div>
                                                    {{ session('success') }}
                                                </div>
                                                </div>
                                </div>
                            @endif
                                    @if (session('error'))
                                    <div class="col-5 mx-auto">
                                        <div class="alert alert-warning text-light d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                        <div>
                                            {{ session('error') }}
                                        </div>
                                        </div>
                                    </div>
                                    @endif
                                        @yield('content')
                                    {{-- Content Section  --}}
                    </div>
                </div>
            </div>
        </main>
    </div>
        <!--   Core JS Files   -->
            <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>

        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#recettes-table').DataTable({
                        "paging": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "responsive": true,
                        "columnDefs": [
                            { "orderable": false, "targets": [5,6,7] }
                        ]
                    });
                });

            </script>

      @yield('scripts')
</body>

</html>


