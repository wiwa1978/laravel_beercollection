<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
    @yield('css')


       <!-- Scripts -->
    <script src="{{ asset('js/backend.js') }}"></script>
</head>
<body>
    <div id="app">
        <div class="header py-4">
                <div class="container">
                    <div class="d-flex">
                        <a class="header-brand" href="{{ route('dashboard')}}">
                            <img
                                src="{{ asset('img/logo/beercollection_logo.png')}}"
                                class="header-brand-img"
                                alt="beer logo">
                        </a>

                        <div class="d-flex order-lg-2 ml-auto">
                            @guest
                                <div class="nav-item d-none d-md-flex">
                                    <a class="btn btn-link" href="{{ route('login') }}">@lang('Login')</a>
                                </div>
                                <div class="nav-item d-none d-md-flex">
                                    <a class="btn btn-link" href="{{ route('register') }}">@lang('Register')</a>
                                </div>
                            @else
                            <div class="dropdown">
                                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                    <span class="avatar" style="background-image: url()"></span>
                                    <span class="ml-2 d-none d-lg-block">
                                    <span class="text-default">{{ auth()->user()->name }}</span>
                                        <small class="text-muted d-block mt-1">{{ auth()->user()->roles->pluck('name')[0] }}</small>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('manual.index') }}">
                                        <i class="dropdown-icon fe fe-help-circle"></i> Manual
                                    </a>
                                    <a class="dropdown-item" href="{{ route('tickets.create') }}">
                                        <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon fe fe-log-out"></i> @lang('Sign out')
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            @endguest
                        </div>

                        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                            <span class="header-toggler-icon"></span>
                        </a>
                    </div>
                </div>
            </div>

        @auth
            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg order-lg-first">
                            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard')}}" class="nav-link">
                                        <i class="fe fe-home"></i> Dashboard
                                    </a>
                                </li>


                               @hasanyrole('Collector|Admin')

                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Overview</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">

                                        <a href="{{ route('beeritems.index') }}" class="dropdown-item ">All items: table view</a>
                                        <a href="{{ route('beeritems.grid') }}" class="dropdown-item ">All items: grid view</a>
                                        <a href="{{ route('beeritems.gallery') }}" class="dropdown-item ">All items: all photos</a>
                                        <a href="{{ route('beeritems.spares') }}" class="dropdown-item ">All items: spare</a>
                                        <a href="{{ route('beeritems.wishlist') }}" class="dropdown-item ">All items: wishlist</a>
                                    </div>
                                </li>

                                @can('manage-beerglasses')
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Beerglasses</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('beeritems.create',['item_type' => 'beerglasses']) }}" class="dropdown-item ">Create Beerglass</a>
                                    <a href="{{ route('beeritems.index',['item_type' => 'beerglasses']) }}" class="dropdown-item ">Beerglasses: table view</a>
                                    <a href="{{ route('beeritems.grid',['item_type' => 'beerglasses']) }}" class="dropdown-item ">Beerglasses: grid view</a>
                                    <a href="{{ route('beeritems.gallery',['item_type' => 'beerglasses']) }}" class="dropdown-item ">Beerglasses: all photos</a>
                                    <a href="{{ route('beeritems.spares', ['item_type' => 'beerglasses']) }}" class="dropdown-item ">Beerglasses: spare</a>
                                    <a href="{{ route('beeritems.wishlist', ['item_type' => 'beerglasses']) }}" class="dropdown-item ">Beerglasses: wishlist</a>
                                    </div>
                                </li>
                                @endcan

                                @can('manage-beerlabels')
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Beerlabels</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('beeritems.create',['item_type' => 'beerlabels']) }}" class="dropdown-item ">Create Beerlabel</a>
                                    <a href="{{ route('beeritems.index',['item_type' => 'beerlabels']) }}" class="dropdown-item ">Beerlabels: table view</a>
                                    <a href="{{ route('beeritems.grid',['item_type' => 'beerlabels']) }}" class="dropdown-item ">Beerlabels: grid view</a>
                                    <a href="{{ route('beeritems.spares', ['item_type' => 'beerlabels']) }}" class="dropdown-item ">Beerlabels: spare</a>
                                    <a href="{{ route('beeritems.wishlist', ['item_type' => 'beerlabels']) }}" class="dropdown-item ">Beerlabels: wishlist</a>
                                    </div>
                                </li>
                                @endcan

                                @can('manage-beerashtrays')
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Beerashtrays</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('beeritems.create',['item_type' => 'beerashtrays']) }}" class="dropdown-item ">Create Beerashtray</a>
                                    <a href="{{ route('beeritems.index', ['item_type' => 'beerashtrays' ]) }}" class="dropdown-item ">Beerashtrays: table view</a>
                                    <a href="{{ route('beeritems.grid',['item_type' => 'beerashtrays']) }}" class="dropdown-item ">Beerashtrays: grid view</a>
                                    <a href="{{ route('beeritems.spares', ['item_type' => 'beerashtrays' ]) }}" class="dropdown-item ">Beerashtrays: spare</a>
                                    <a href="{{ route('beeritems.wishlist', ['item_type' => 'beerashtrays' ]) }}" class="dropdown-item ">Beerashtrays: wishlist</a>
                                    </div>
                                </li>
                                @endcan

                                @can('manage-beercontainers')
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Beercontainers</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('beeritems.create',['item_type' => 'beercontainers']) }}" class="dropdown-item ">Create Beercontainer</a>
                                    <a href="{{ route('beeritems.index', ['item_type' => 'beercontainers' ]) }}" class="dropdown-item ">Beercontainers: table view</a>
                                    <a href="{{ route('beeritems.grid',['item_type' => 'beercontainers']) }}" class="dropdown-item ">Beercontainers: grid view</a>
                                    <a href="{{ route('beeritems.spares', ['item_type' => 'beercontainers' ]) }}" class="dropdown-item ">Beercontainers: spare</a>
                                    <a href="{{ route('beeritems.wishlist', ['item_type' => 'beercontainers' ]) }}" class="dropdown-item ">Beercontainers: wishlist</a>
                                    </div>
                                </li>
                                @endcan

                                @can('manage-beerbottles')
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Beerbottles</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('beeritems.create',['item_type' => 'beerbottles']) }}" class="dropdown-item ">Create Beerbottle</a>
                                    <a href="{{ route('beeritems.index', ['item_type' => 'beerbottles' ]) }}" class="dropdown-item ">Beerbottles: table view</a>
                                    <a href="{{ route('beeritems.grid',['item_type' => 'beerbottles']) }}" class="dropdown-item ">Beerbottles: grid view</a>
                                    <a href="{{ route('beeritems.spares', ['item_type' => 'beerbottles' ]) }}" class="dropdown-item ">Beerbottles: spare</a>
                                    <a href="{{ route('beeritems.wishlist', ['item_type' => 'beerbottles' ]) }}" class="dropdown-item ">Beerbottles: wishlist</a>
                                    </div>
                                </li>
                                @endcan

                                @can('manage-beerplateaus')
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Beerplateaus</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('beeritems.create',['item_type' => 'beerplateaus']) }}" class="dropdown-item ">Create Beerplateau</a>
                                    <a href="{{ route('beeritems.index', ['item_type' => 'beerplateaus' ]) }}" class="dropdown-item ">Beerplateaus: table view</a>
                                    <a href="{{ route('beeritems.grid',['item_type' => 'beerplateaus']) }}" class="dropdown-item ">Beerplateaus: grid view</a>
                                    <a href="{{ route('beeritems.gallery',['item_type' => 'beerplateaus']) }}" class="dropdown-item ">Beerplateaus: all photos</a>
                                    <a href="{{ route('beeritems.spares', ['item_type' => 'beerplateaus' ]) }}" class="dropdown-item ">Beerplateaus: spare</a>
                                    <a href="{{ route('beeritems.wishlist', ['item_type' => 'beerplateaus' ]) }}" class="dropdown-item ">Beerplateaus: wishlist</a>
                                    </div>
                                </li>
                                @endcan

                                @can('manage-beeradvertisements')
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Beeradvertisements</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('beeritems.create',['item_type' => 'beeradvertisements']) }}" class="dropdown-item ">Create Beeradvertisements</a>
                                    <a href="{{ route('beeritems.index', ['item_type' => 'beeradvertisements' ]) }}" class="dropdown-item ">Beeradvertisements: table view</a>
                                    <a href="{{ route('beeritems.grid',['item_type' => 'beeradvertisements']) }}" class="dropdown-item ">Beeradvertisements: grid view</a>
                                    <a href="{{ route('beeritems.spares', ['item_type' => 'beeradvertisements' ]) }}" class="dropdown-item ">Beeradvertisements: spare</a>
                                    <a href="{{ route('beeritems.wishlist', ['item_type' => 'beeradvertisements' ]) }}" class="dropdown-item ">Beeradvertisements: wishlist</a>
                                    </div>
                                </li>
                                @endcan

                                @can('manage-beercoasters')
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Beercoasters</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('beeritems.create',['item_type' => 'beercoasters']) }}" class="dropdown-item ">Create Beercoaster</a>
                                    <a href="{{ route('beeritems.index', ['item_type' => 'beercoasters' ]) }}" class="dropdown-item ">Beercoasters: table view</a>
                                    <a href="{{ route('beeritems.grid',['item_type' => 'beercoasters']) }}" class="dropdown-item ">Beercoasters: grid view</a>
                                    <a href="{{ route('beeritems.spares', ['item_type' => 'beercoasters' ]) }}" class="dropdown-item ">Beercoasters: spare</a>
                                    <a href="{{ route('beeritems.wishlist', ['item_type' => 'beercoasters' ]) }}" class="dropdown-item ">Beercoasters: wishlist</a>
                                    </div>
                                </li>
                                @endcan

                                @can('manage-beerstonejugs')
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Beerstonejugs</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('beeritems.create',['item_type' => 'beerstonejugs']) }}" class="dropdown-item ">Create Beerstonejugs</a>
                                    <a href="{{ route('beeritems.index', ['item_type' => 'beerstonejugs' ]) }}" class="dropdown-item ">Beerstonejugs: table view</a>
                                    <a href="{{ route('beeritems.grid',['item_type' => 'beerstonejugs']) }}" class="dropdown-item ">Beerstonejugs: grid view</a>
                                    <a href="{{ route('beeritems.spares', ['item_type' => 'beerstonejugs' ]) }}" class="dropdown-item ">Beerstonejugs: spare</a>
                                    <a href="{{ route('beeritems.wishlist', ['item_type' => 'beerstonejugs' ]) }}" class="dropdown-item ">Beerstonejugs: wishlist</a>
                                    </div>
                                </li>
                                @endcan

                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Manage</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('collections.index')}}" class="dropdown-item">
                                        <i class="fe fe-box"></i>  Manage Collections
                                    </a>
                                    <a href="{{ route('tags.index') }}" class="dropdown-item"><i class="fe fe-box"></i>  Manage Tags</a>
                                    <a href="{{ route('categories.index') }}" class="dropdown-item"><i class="fe fe-box"></i>  Manage Categories</a>
                                    <a href="{{ route('breweries.index') }}" class="dropdown-item"><i class="fe fe-box"></i>  Manage Breweries</a>
                                    <a href="{{ route('beeritems.importexport') }}" class="dropdown-item"><i class="fe fe-box"></i>  Import & Export</a>

                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Support</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('tickets.create',['item_type' => 'beerglasses']) }}" class="dropdown-item ">Create Ticket</a>
                                    <a href="{{ route('tickets.index') }}" class="dropdown-item ">Tickets Overview</a>

                                    </div>
                                </li>

                                @endhasrole

                                @hasanyrole('Admin')

                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Manage</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{ route('users.index') }}" class="dropdown-item ">Manage Users</a>
                                    <a href="{{ route('roles.index') }}" class="dropdown-item ">Manage Roles</a>
                                    <a href="{{ route('permissions.index') }}" class="dropdown-item ">Manage Permissions</a>
                                    </div>
                                </li>
                               @endhasrole

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endauth

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
 <script src="../js/owl.carousel.min.js"></script>
    <!-- Scripts -->
    @yield('scripts')
</html>
