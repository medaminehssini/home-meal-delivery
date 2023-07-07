
    <!-- start: TOP NAVBAR -->
    <header class="navbar navbar-default navbar-static-top">
        <!-- start: NAVBAR HEADER -->
        <div class="navbar-header">
            <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
                <i class="ti-align-justify"></i>
            </a>
            <a class="navbar-brand" href="{{ url('/', []) }}">
                <img style="    width: 165px;
                height: 51px;" src="{{ url('images/kgsexpress.png', []) }}" />
            </a>
            <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
                <i class="ti-align-justify"></i>
            </a>
            <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="ti-view-grid"></i>
            </a>
        </div>
        <!-- end: NAVBAR HEADER -->
        <!-- start: NAVBAR COLLAPSE -->
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-right">
                <!-- start: MESSAGES DROPDOWN -->
                <li class="dropdown">
                    <a href class="dropdown-toggle" data-toggle="dropdown">
                        @if ($notification->count()>0) <span class="dot-badge partition-red"></span>     @endif <i class="fa fa-bell"></i> <span>Notification</span>
                    </a>
                    <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
                        <li>
                            @if ($notification->count()>0)
                              <span class="dropdown-header"> Vous avez de nouvelles notifications</span>
                            @else 
                              <span class="dropdown-header">  Il n'y a pas de nouvelles notifications  </span>      
                            @endif
                        </li>
                        <li>
                            <div class="drop-down-wrapper ps-container">
                                <ul>
                                    @foreach ($notification as $item)
                                        
                                    @if (Auth::guard('admin')->check())
                                            <li class="unread">
                                            <a href="{{ url('liste/fournisseur?fournisseur=', []) }}{{$item->id}}" class="unread">
                                                    <div class="clearfix">
                                                        <div class="thread-image">
                                                            <img style=" width: 45px;" src="{{ url('', []) }}/{{$item->logo}}" alt="">
                                                        </div>
                                                        <div class="thread-content">
                                                            <span class="author">{{$item->nom}}</span>
                                                            <span class="preview">{{$item->adresse}}</span>
                                                            <span class="time">{{ $item->created_at}}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                    @if (Auth::guard('fournisseur')->check())
                                        <li class="unread">
                                            <a href="{{ url('fournisseur/liste/restaurant?restaurant=', []) }}{{$item->id}}" class="unread">
                                                    <div class="clearfix">
                                                        <div class="thread-image">
                                                            <img style=" width: 45px;" src="{{ url('', []) }}/{{$item->logo}}" alt="">
                                                        </div>
                                                        <div class="thread-content">
                                                            <span class="author">{{$item->nom}}</span>
                                                            @if ($item->etat == 2)
                                                               <span style="
                                                               background-color: red;
                                                               padding: 5px;
                                                               color: white;
                                                               border-radius: 5px;
                                                               margin: 6px 4px;
                                                               font-size: 13px;
                                                               " class="preview">{{$item->note}}</span>
                                                            @else
                                                               <span  style="background-color: green;         padding: 5px;
                                                               color: white;
                                                               border-radius: 5px;
                                                               margin: 6px 4px;
                                                               font-size: 13px;"  class="preview">Votre restaurant a été accepté</span>
                                                            @endif
                                                            <span class="time">{{ $item->created_at}}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                        </li>
                                    @endif
                                        @if (Auth::guard('transporteur')->check())
                                            <li class="unread">
                                                <a href="{{ url('transporteur/liste/commande?commande=', []) }}{{$item->id}}" class="unread">
                                                        <div class="clearfix">
                                                            <div class="thread-content">
                                                                <span class="author">{{$item->user->nom}}</span>
                                                                <span class="preview">{{$item->ville}}</span>
                                                                <span class="time">{{ $item->created_at}}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                            </li>                                            
                                        @endif
                                    @endforeach


                                    
                                </ul>
                            </div>
                        </li>
                        <li class="view-all">
                            <a href="{{ url('liste/fournisseur?fournisseur=all', []) }}">
                                voir tout
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end: MESSAGES DROPDOWN -->

                <!-- start: USER OPTIONS DROPDOWN -->
                <li class="dropdown current-user">
                    <a href class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ url('', []) }}/{{Auth::user()->image}}" style="height: 40px;width: 40px;" alt="Peter"> <span class="username">
                            @if (Auth::guard('admin')->check())
                                {{Auth::guard('admin')->user()->prenom}}
                            @else
                                @if (Auth::guard('transporteur')->check())
                                     {{Auth::guard('transporteur')->user()->prenom}}
                                @else  
                                     {{Auth::guard('fournisseur')->user()->prenom}}
                                @endif
                                
                            @endif
                        <i class="ti-angle-down"></i></i></span>
                    </a>
                    <ul class="dropdown-menu dropdown-dark">
                        <li>
                            <a href="{{ url('/', []) }}/edit/profile">
                                Mon profil
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/logout', []) }}">
                                Déconnexion
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end: USER OPTIONS DROPDOWN -->
            </ul>
            <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
            <div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
                <div class="arrow-left"></div>
                <div class="arrow-right"></div>
            </div>
            <!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
        </div>

        <!-- end: NAVBAR COLLAPSE -->
    </header>
    <!-- end: TOP NAVBAR -->

