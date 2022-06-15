@extends('layouts.app')

@section('content')
    <div class="main-section package">

        <h2 class="title">Select Package</h2>
        <h5 class="sub-title"> Unlimited Music & SFX - Download & get life time license! </h5>
        <div class="container">
            <form id="formpackage" method="POST" action="{{ url('save-package') }}" role="form" autocomplete="off">
                {{-- <form method="GET" action="{{url('payment')}}" role="form" autocomplete="off"> --}}
                @csrf
                <div class="row" id="my_radio_box">

                    <div class="col-lg-4">

                        <div class="pkg-group">
                            <input type="radio" checked id="regular" value="-1" name="package">
                            <label for="regular">Regular</label>
                        </div>

                        <div class="pkg-box">

                            <p><span><i class="fa-solid fa-circle-check"></i></span> Pay at regular price.</p>
                            <p><span><i class="fa-solid fa-circle-check"></i></span>Pay For Each File You Download</p>
                            <p><span><i class="fa-solid fa-circle-check"></i></span>All Social Media Platforms</p>
                            <p><span><i class="fa-solid fa-circle-check"></i></span>Paid Ads</p>
                            <p><span><i class="fa-solid fa-circle-check"></i></span>Commercial Projects</p>
                            <p><span><i class="fa-solid fa-circle-check"></i></span>Client Work</p>
                            <p><span><i class="fa-solid fa-circle-check"></i></span>Podcasts</p>
                            <p><span><i class="fa-solid fa-circle-check"></i></span>Any online platform</p>
                            <p><span><i class="fa-solid fa-circle-check"></i></span>Broadcast & TV</p>
                            <p><span><i class="fa-solid fa-circle-check"></i></span>Usage License Provided</p>
                            {{-- <p>&lt; More Details &gt;</p> --}}

                        </div>

                    </div>
                    @foreach ($packages as $package)
                        <div class="col-lg-4">

                            <div class="pkg-group">
                                <input type="radio" id="{{ $package->name }}" value="{{ $package->id }}" name="package">
                                <label for="silver">{{ $package->name }} @ $ {{ $package->price }}/mo.</label>
                            </div>

                            <div class="pkg-box">

                                <p><span><i class="fa-solid fa-circle-check"></i></span>{{ $package->downloads }}
                                    download/month.</p>
                                @foreach ($package->package_detail as $detail)
                                    <p><span><i class="fa-solid fa-circle-check"></i></span>{{ $detail->description }}</p>
                                @endforeach


                            </div>

                        </div>
                    @endforeach



                    {{-- <div class="col-lg-4">

                        <div class="pkg-group gold">
                            <input type="radio" id="gold" name="package">
                            <label for="gold">Gold @ $00.00/mo.</label>
                        </div>

                        <div class="pkg-box gold">

                            <p>20 downloads/mo.</p>
                            <p>&lt; More Details &gt;</p>

                        </div>

                    </div> --}}
                    <div class="row">
                        <div class="container">
                            <div class="col-lg-12 sign-up text-center mt-5">
                                <p><span class="sign-up-li"><i class="fa-solid fa-circle-check"></i></span> Secure
                                    Payments</p>
                                <div class="payment-img">
                                    <img src="{{ asset('frontend/images/payments.jpg') }}">

                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user())
                        {{-- <div id="paypal-button-container"></div> --}}
                        <div class="col-lg-12 text-end my-5">

                            <button
                                @if ($modal == 0) type="submit" @else type="button" onclick="packagemodal()" @endif
                                class="custom-btn primary-btn">Confirm
                                Purchase</button>
                        </div>
                    @endif
            </form>

        </div>
    </div>

    </div>


    <div class="package-bottom-section ">

        <h2 class="title">Enterprise Package</h2>
        <p>Specialized Music & Sound Effects</p>
        <p>Customiized licesence & Terms</p>
        <p>Exclusive Ownership of Files</p>
        <div class="py-5 text-center">
            <a href="{{ url('/contact') }}" class="custom-btn primary-btn"> Contact Us </a>
        </div>
    </div>
@endsection

@push('include-js')
    <script>
        var value = -1;
        $(document).ready(function() {
            var $radios = $('input[name=package]').change(function() {
                value = $radios.filter(':checked').val();

            });
        });

        function packageselect() {
            $('#formpackage').submit();
        }

        function packagemodal() {
            if (value != -1) {
                $('#package-modal').modal('show');
            } else {
                packageselect();
            }
        }
    </script>
@endpush
