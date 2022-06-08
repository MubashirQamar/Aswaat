<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aswat') }}</title>

    <link rel="shortcut icon" href="images/favicon.ico">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.png') }}">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/2.0.4/wavesurfer.min.js"></script> --}}
    <script src="https://unpkg.com/wavesurfer.js@6.2.0/dist/wavesurfer.js"></script>
    <script>
        function formatTimecode(sec) {
            var seconds = sec;
            return new Date(seconds * 1000).toISOString().substr(14, 5)
        }

        function updatetime2(id, time) {
            var current_music = id;
            document.getElementById("currenttime" + id).text = 'dasdsad';
            // document.getElementById('currenttime' + id).innerHTML();
            console.log(time);
        }
    </script>
</head>

<body>

    {{-- nav starts --}}
    @include('includes.nav')
    {{-- nav ends --}}

    <main>
        @yield('content')
        {{-- {{ session('success') }} --}}
    </main>

    {{-- Footer Starts --}}
    @include('includes.footer')

    <div id="soicalmedialink" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h5>Do you like this? Share with your friends!</h5>
                    <div class="mt-5">
                        <input type="hidden" id="share_url">
                        <ul class="share_links">
                            <li class="bg_fb"><a href="#" class="share_icon" rel="tooltip"
                                    title="Facebook"><i class="fa-brands fa-facebook"></i></a></li>

                            <li class="bg_insta"><a href="#" class="share_icon" rel="tooltip"
                                    title="Instagram"><i class="fa-brands fa-instagram"></i></a></li>

                            <li class="bg_whatsapp"><a href="#" class="share_icon" rel="tooltip"
                                    title="Whatsapp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a></li>
                            <li class="bg_copylink"><a href="#" class="share_icon" rel="tooltip"
                                    title="Copy Link"><i class="fa-solid fa-link"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade custom-modal" id="error" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Download Limit Exceeded</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Sorry You Can Not Add More Items To carts</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/cart') }}"><button type="button" class="btn btn-secondary">Go To
                            Cart</button></a>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Listen To More</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->

    <div class="modal fade custom-modal" id="package-modal" tabindex="-1" aria-labelledby="errorPackageLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorPackageLabel">You already have a package. </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to continue? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="packageselect()" class="btn btn-secondary">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Ends --}}
</body>

</html>

<script src="{{ asset('frontend/vendor/jquery.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
{{-- <script src="https://www.paypal.com/sdk/js?client-id=AQajALW5chfp03ViPd4WDbPlBCPWIkF1BbqdLcc7zvEu56ckFr3s1XVt3LuObxKrbvkc4BWerJ0au9rp&components=YOUR_COMPONENTS"></script> --}}
@stack('include-js')


<script type="text/javascript">
    $(".update-cart").change(function(e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $(".add-to-cart").click(function(e) {
        e.preventDefault();

        var ele = $(this).parent("button").attr("data-id");
        console.log(ele);
        $.ajax({
            url: '{{ route('add.to.cart') }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele,

            },
            success: function(response) {
                //    window.location.reload();

                if (response.data == 'Success') {
                    $('#exampleModal').modal('show');
                } else {
                    $('#error').modal('show');
                }
            }
        });
    });

    $(".add-favourite").click(function(e) {

        e.preventDefault();
        var current = $(this);
        var ele = $(this).parent("button").attr("data-id");
        // $(this).css({"color": "yellow"});
        console.log(ele);
        $.ajax({
            url: '{{ route('add-to-Favourite') }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele,

            },
            success: function(response) {
                if (response.status == 'remove') {
                    current.css({
                        "color": "white"
                    });
                } else {
                    current.css({
                        "color": "yellow"
                    });

                }
                //    window.location.reload();

                // $('#exampleModal').modal('show');
            }
        });
    });

    $(".download").click(function(e) {

        e.preventDefault();
        var current = $(this);
        var ele = $(this).parent("button").attr("data-id");
        var link = $(this).parent("button").attr("data-href");
        console.log(link)
        var element = document.createElement('a');
        element.setAttribute('href', link);
        element.setAttribute('download', link);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
        //   current.addEventListener('click', download);


    });


    $(".share").click(function(e) {

        e.preventDefault();
        var current = $(this);
        var ele = $(this).parent("button").attr("data-href");
        console.log(ele);
        // $(this).css({"color": "yellow"});
        $('#share_url').val(ele);
        // console.log(ele);

        $('#soicalmedialink').modal('show');
    });
    $(".remove-from-cart").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        if (confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });

    $(".bg_fb").click(function(e) {
        e.preventDefault();
        var link = $('#share_url').val();
        // let params = `;
        window.open('https://www.facebook.com/sharer/sharer.php?' + link, 'popUpWindow',
            'height=500,width=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes'
        );
    });
    $(".bg_insta").click(function(e) {
        e.preventDefault();
        var link = $('#share_url').val();
        // let params = `;
        window.open('https://www.instagram.com/?url=' + link, 'popUpWindow',
            'height=500,width=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes'
        );
    });
    $(".bg_whatsapp").click(function(e) {
        e.preventDefault();
        var link = $('#share_url').val();
        // let params = `;
        window.open('https://api.whatsapp.com/send?text=' + link, 'popUpWindow',
            'height=500,width=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes'
        );
    });

    $(".bg_copylink").click(function(e) {
        e.preventDefault();
        var link = $('#share_url').val();
        // let params = `;

        navigator.clipboard.writeText(link);

        // $(this).append('<p>URL copied!</p>')
        // window.open('https://api.whatsapp.com/send?text='+link,'popUpWindow','height=500,width=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
    });
</script>
