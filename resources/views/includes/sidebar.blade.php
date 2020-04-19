<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('dist')}}/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Sofraa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">s
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist')}}/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="home" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ url(route('users.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ url(route('clients.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>Clients</p>
                    </a>
               </li>


                <li class="nav-item">
                    <a href="{{ url(route('restaurants.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-map-marker-alt"></i>
                        <p>Restaurant</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ url(route('products.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart "></i>
                        <p>Products</p>
                    </a>
                </li>




                <li class="nav-item">
                    <a href="{{ url(route('orders.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-chart-line "></i>
                        <p>Orders</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ url(route('districts.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-building"></i>
                        <p>Districts</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ url(route('offers.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-calendar-alt"></i>
                        <p>Offers</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url(route('cities.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-building"></i>
                        <p>Cities</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url(route('categories.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url(route('contacts.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>Contacts</p>
                    </a>
                </li>


{{--                <li class="nav-item">--}}
{{--                    <a href="{{ url(route('roles.index')) }}" class="nav-link">--}}
{{--                        <i class="nav-icon fa fa-sticky-note"></i>--}}
{{--                        <p>Roles</p>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="nav-item">
                    <a href="{{ url(route('settings.index')) }}" class="nav-link">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>




                <li class="nav-item">
                    <a href="{{ url(route('user.logout')) }}" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
