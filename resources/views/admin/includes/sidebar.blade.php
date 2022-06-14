<div id="aside" class="app-aside modal fade nav-expand">
    <div class="left navside black dk" layout="column">
        <div class="navbar no-radius">
            <!-- brand -->
            <a class="navbar-brand">
                <div ui-include="'{{ asset('assets/images/logo.svg') }}"></div>
                <img src="{{ asset('assets/images/logo.png') }}" alt="." class="hide">
                <span class="hidden-folded inline">ASWAAT</span>
            </a>
            <!-- / brand -->
        </div>
        <div flex-no-shrink>
            <div ui-include="'../views/blocks/aside.top.2.html'"></div>
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll nav-stacked nav-active-primary">

                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        {{-- <small class="text-muted">Main</small> --}}
                    </li>

                    <li class="{{ (request()->is('admin')) ? 'active' : '' }}">
                        <a href="{{ url('/admin') }}">
                            <span class="nav-icon">
                                <i class="material-icons">&#xe3fc;
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/artist*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/artist') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-a">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Artist</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/category*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/category') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-icons">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Category</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/sub-category*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/sub-category') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-icons">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Album</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/music-type*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/music-type') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-icons">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Music Type</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/genre*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/genre') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-genderless">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Genre</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/instrument*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/instrument') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-drum">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Instrument</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/package*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/package') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-cubes">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Package</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/subscriber*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/subscriber') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-users">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Subscriber</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/songs*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/songs') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-music">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Home Page</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('admin/album*')) ? 'active' : '' }}">
                        <a href="{{ url('/admin/album') }}">
                            <span class="nav-icon">
                                <i class="fa-solid fa-icons">
                                    <span ui-include="'{{ asset('assets/images/i_0.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">All Files</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a>
                            <span class="nav-caret">
                                <i class="fa fa-caret-down"></i>
                            </span>
                            <span class="nav-label">
                                <b class="label rounded label-sm primary">5</b>
                            </span>
                            <span class="nav-icon">
                                <i class="material-icons">&#xe5c3;
                                    <span ui-include="'{{ asset('assets/images/i_1.svg') }}"></span>
                                </i>
                            </span>
                            <span class="nav-text">Apps</span>
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <a href="inbox.html">
                                    <span class="nav-text">Inbox</span>
                                </a>
                            </li>
                            <li>
                                <a href="contact.html">
                                    <span class="nav-text">Contacts</span>
                                </a>
                            </li>
                            <li>
                                <a href="calendar.html">
                                    <span class="nav-text">Calendar</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}



                </ul>
            </nav>
        </div>
        <div flex-no-shrink>
            {{-- <div ui-include="'../views/blocks/aside.bottom.0.html'"></div> --}}
        </div>
    </div>
</div>
