<!DOCTYPE html>
<html lang="en">
{{-- head start --}}
@include('admin.includes.head')
{{-- head start --}}

<body>
    <div class="app" id="app">

        <!-- ############ LAYOUT START-->

        <!-- aside -->
        @include('admin.includes.sidebar')
        <!-- / aside -->

        <!-- content -->
        <div id="content" class="app-content box-shadow-z1" role="main">
                {{--  nav start --}}
                @include('admin.includes.nav')
                {{--  nav ends --}}
                {{-- footer start --}}
                @include('admin.includes.footer')
                {{-- footer ends --}}
            <div ui-view class="app-body" id="view">

                <!-- ############ PAGE START-->

                @yield('content')


                <!-- ############ PAGE END-->

            </div>
        </div>
        <!-- / content -->

        <!-- theme switcher -->

        <!-- / -->

        <!-- ############ LAYOUT END-->

    </div>
    @include('admin.includes.footer_script')

</body>

</html>
