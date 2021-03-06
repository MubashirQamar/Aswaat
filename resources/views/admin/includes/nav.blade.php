<div class="app-header white box-shadow">
    <div class="navbar">
        <!-- Open side - Naviation on mobile -->
        <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
            <i class="material-icons">&#xe5d2;</i>
        </a>
        <!-- / -->

        <!-- Page title - Bind to $state's title -->
        <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>

        <!-- navbar right -->
        <ul class="nav navbar-nav pull-right">

            <li class="nav-item dropdown">

                <a class="nav-link clear dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="avatar w-32">
                        <img src="{{ asset('assets/images/a0.jpg') }}" alt="...">
                        <i class="on b-white bottom"></i>
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                          <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </button>
                        </form>
                    </a>

                </div>
              </li>

            <li class="nav-item hidden-md-up">
                <a class="nav-link" data-toggle="collapse" data-target="#collapse">
                    <i class="material-icons">&#xe5d4;</i>
                </a>
            </li>
        </ul>
        <!-- / navbar right -->

        <!-- navbar collapse -->
        <div class="collapse navbar-toggleable-sm" id="collapse">
            <div ui-include="'../views/blocks/navbar.form.right.html'"></div>
            <!-- link and dropdown -->
            {{-- <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href data-toggle="dropdown">
                        <i class="fa fa-fw fa-plus text-muted"></i>
                        <span>New</span>
                    </a>
                    <div ui-include="'../views/blocks/dropdown.new.html'"></div>
                </li>
            </ul> --}}
            <!-- / -->
        </div>
        <!-- / navbar collapse -->
    </div>
</div>
