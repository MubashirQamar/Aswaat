<footer>

    <div class="container-fluid footer-top">
        <div class="text-center">
            <img src="{{asset('frontend/images/logo.png')}}" width="200"/>
        </div>

        <div class="footer-menu container">
            <ul>

                <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                <li><a href="{{ url('/about') }}">About Us</a></li>
                <li><a href="{{ url('/terms') }}">Terms & Conditions</a></li>
                <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>

            </ul>
        </div>

        <div class="footer-social">
            <ul>

                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>

            </ul>
        </div>


    </div>

    <div class="footer-bottom">

        <p style="text-align: center"> Copyright &copy;
            <script>
                document.write(new Date().getFullYear())
            </script> Aswaat All Rights Reserved
        </p>

    </div>

</footer>
