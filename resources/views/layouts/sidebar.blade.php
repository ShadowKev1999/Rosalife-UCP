<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{asset('images/rosalife-images/logo_mini.png') }}" alt="AdminLTE Logo" class="brand-image" style="">
        <span class="brand-text font-weight-light">RosaLife</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/skins-avatar/'.Auth::guard('account')->user()->SkinID.'.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('profile')}}" class="d-block">{{Auth::guard('account')->user()->Name}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">ALLGEMEINES</li>
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('profile')}}" class="nav-link {{ Route::is('profile') ? 'active' : '' }}">
                        <i class="nav-icon far fa-user"></i>
                        <p>Mein Profil</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teamspeak') }}" class="nav-link {{ Route::is('teamspeak') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-microphone"></i>
                        <p>Teamspeak</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('toplist') }}" class="nav-link {{ Route::is('toplist') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>Toplist</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('server_timeline') }}" class="nav-link {{ Route::is('server_timeline') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-bolt"></i>
                        <p>Server Feed</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('server_vehicleshops') }}" class="nav-link {{ Route::is('server_vehicleshops') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-building"></i>
                        <p>Autohäuser</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('map') }}" class="nav-link {{ Route::is('map') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-map"></i>
                        <p>Karte</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('server_races') }}" class="nav-link {{ Route::is('server_races') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-gamepad"></i>
                        <p>Rennstrecken</p>
                    </a>
                </li>
                <li class="nav-header">MARKTPLATZ</li>
                <li class="nav-item">
                    <a href="{{ route('server_marketplace') }}" class="nav-link {{ Route::is('server_marketplace') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-suitcase"></i>
                        <p>Angebote</p>
                    </a>
                </li>
                <li class="nav-header">FRAKTION</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-sitemap"></i>
                        <p>Regierung</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Fraktionen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>Gangzones</p>
                    </a>
                </li>
                <li class="nav-header">SHOP</li>
                <li class="nav-item">
                    <a href="{{route('couponshop')}}" class="nav-link {{ Route::is('couponshop') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>Coupons</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('coupons')}}" class="nav-link {{ Route::is('coupons') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-certificate"></i>
                        <p>Meine Coupons</p>
                        <span class="badge badge-info right">{{$mycoupons->count()}}</span>
                    </a>
                </li>
                <li class="nav-header">SUPPORT</li>
                <li class="nav-item">
                    <a href="{{route('team')}}" class="nav-link {{ Route::is('team') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-eye"></i>
                        <p>Team</p>
                        @if($teamOnline->count() > 0)
                        <span class="badge badge-success right">{{$teamOnline->count()}}</span>
                        @else
                        <span class="badge badge-danger right">{{$teamOnline->count()}}</span>
                        @endif
                    </a>
                </li>
                @if(Auth::guard('account')->user()->Admin > 0)
                <li class="nav-header">TEAM</li>
                @if(Route::is('admin_atms_index', 'admin_jobinfo_index', 'admin_player_history', 'admin_pickups_index', 'admin_actors_index'))
                <li class="nav-item menu-open">
                @else
                <li class="nav-item">
                @endif
                    @if(Route::is('admin_atms_index', 'admin_jobinfo_index', 'admin_player_history', 'admin_pickups_index', 'admin_actors_index'))
                    <a href="#" class="nav-link active">
                    @else
                    <a href="#" class="nav-link">
                    @endif
                        <i class="nav-icon fa fa-table"></i>
                        <p>Server Infos <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin_atms_index')}}" class="nav-link {{ Route::is('admin_atms_index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>ATMs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_jobinfo_index')}}" class="nav-link {{ Route::is('admin_jobinfo_index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>Jobinfos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_player_history')}}" class="nav-link {{ Route::is('admin_player_history') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>Spielerzahlen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_pickups_index')}}" class="nav-link {{ Route::is('admin_pickups_index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>Server Pickups</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_actors_index')}}" class="nav-link {{ Route::is('admin_actors_index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>Server Actors</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('banlist')}}" class="nav-link {{ Route::is('banlist') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-gavel"></i>
                        <p>Server Bans</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('radiostation')}}" class="nav-link {{ Route::is('radiostation') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-rss-square"></i>
                        <p>Radiosender</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('busroutes')}}" class="nav-link {{ Route::is('busroutes') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info"></i>
                        <p>Busrouten</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('carinfos')}}" class="nav-link {{ Route::is('carinfos') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info"></i>
                        <p>Fahrzeuginfos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('multiaccount_index')}}" class="nav-link {{ Route::is('multiaccount_index') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-puzzle-piece"></i>
                        <p>Multiaccounts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('emailblacklist')}}" class="nav-link {{ Route::is('emailblacklist') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-lock"></i>
                        <p>Email-Blacklist</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('servermaps')}}" class="nav-link {{ Route::is('servermaps') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-map-marker"></i>
                        <p>Server Maps</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('serverincidents')}}" class="nav-link {{ Route::is('serverincidents') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-info"></i>
                        <p>Serverereignisse</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('furniture_categories')}}" class="nav-link {{ Route::is('furniture_categories') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-crop"></i>
                        <p>Möbelsystem</p>
                    </a>
                </li>
                @if(Route::is('admin_houses_index', 'admin_fuelstation_index', 'admin_stores_index', 'admin_ammunations_index', 'admin_garages_index'))
                <li class="nav-item menu-open">
                @else
                <li class="nav-item">
                @endif
                    @if(Route::is('admin_houses_index', 'admin_fuelstation_index', 'admin_stores_index', 'admin_ammunations_index', 'admin_garages_index'))
                    <a href="#" class="nav-link active">
                    @else
                    <a href="#" class="nav-link">
                    @endif
                        <i class="nav-icon fa fa-table"></i>
                        <p>Immobilien <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin_houses_index')}}" class="nav-link {{ Route::is('admin_houses_index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>Häuser</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_fuelstation_index')}}" class="nav-link {{ Route::is('admin_fuelstation_index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>Tankstellen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_stores_index')}}" class="nav-link {{ Route::is('admin_stores_index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>Geschäfte</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_ammunations_index')}}" class="nav-link {{ Route::is('admin_ammunations_index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>Ammunations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin_garages_index')}}" class="nav-link {{ Route::is('admin_garages_index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-share"></i>
                                <p>Garagen</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>