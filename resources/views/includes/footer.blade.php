<footer class="footer1">

    <div class="container-fluid footer-top">
        <div class="text-center">
            <img src="{{asset('frontend/images/logo.png')}}" width="200"/>
        </div>

        <div class="footer-menu container">
            <ul>

                <li><a href="{{ url('/contact') }}">وسائل التواصل</a></li>
                <li><a href="{{ url('/about') }}">من نحن</a></li>
                <li><a href="{{ url('/terms') }}">الشروط والأحكام</a></li>
                <li><a href="{{ url('/privacy') }}">سياسة الخصوصية</a></li>

            </ul>
        </div>

        <div class="footer-social">
            <ul>

                <li><a href="https://www.youtube.com/channel/UCSuD056zHna4Nq9CCPeJSMg" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                <li><a href="https://www.instagram.com/aswwatcom/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                {{-- <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li> --}}
                <li><a href="https://mobile.twitter.com/aswwatcom?s=11&t=iTg8fP612PaOZ6AV2rZ3-g" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>

            </ul>
        </div>


    </div>

    <div class="footer-bottom">

        <p style="text-align: center">
            <script>
                document.write(new Date().getFullYear())
            </script> جميع الحقوق  محفوظة لدى ( أصوات )
        </p>

    </div>

</footer>
