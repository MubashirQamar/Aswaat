@extends('layouts.app')

@section('content')
    <div class="main-section package">

        <h2 class="title">حدد الباقة</h2>
        <h5 class="sub-title"> غير محدود  موسيقى و مؤثرات صوتية مع ترخيص عدم ممنانعة استخدام مدى الحياة</h5>
        <div class="container">
            <form id="formpackage" method="POST" action="{{ url('save-package') }}" role="form" autocomplete="off">
                {{-- <form method="GET" action="{{url('payment')}}" role="form" autocomplete="off"> --}}
                @csrf
                <div class="row" id="my_radio_box">

                    <div class="col-lg-4" style="display: none;">

                        <div class="pkg-group">
                            <input type="radio" checked id="regular" value="-1" name="package">
                            <label for="regular">عادي</label>
                        </div>

                        <div class="pkg-box">

                            <p>دفع بالاشتراك للباقة العادية<span ><i class="fa-solid fa-circle-check"></i></span></p>
                            <p>دفع بدون اشتراك قطعة واحدة<span><i class="fa-solid fa-circle-check"></i></span></p>
                            <p>جميع منصات وسائل التواصل الاجتماعي<span><i class="fa-solid fa-circle-check"></i></span></p>
                            <p> إعلانات مدفوعة ادية <span ><i class="fa-solid fa-circle-check"></i></span></span></p>
                            <p> المشاريع التجارية<span class="danger-text"><i class="fa-solid fa-circle-xmark"></i></span></p>
                            <p>العملاء <span class="danger-text"><i class="fa-solid fa-circle-xmark"></i></span></p>
                            <p>بودكاست<span class="danger-text"><i class="fa-solid fa-circle-xmark"></i></span></p>
                            <p>المنصات عبر الانترنت<span class="danger-text"><i class="fa-solid fa-circle-xmark"></i></span></p>
                            <p> اذاعة وتلفزيون<span class="danger-text"><i class="fa-solid fa-circle-xmark"></i></span></p>
                            <p> ترخيص عدم ممانعة <span ><i class="fa-solid fa-circle-check"></i></span></span></p>


                            {{-- <p>&lt; More Details &gt;</p> --}}

                        </div>

                    </div>
                    @foreach ($packages as $package)
                        <div class="col-lg-4">

                            <div class="pkg-group">
                                @if($package->id != 4)
                                <input type="radio" id="{{ $package->name }}" value="{{ $package->id }}" name="package">
                                @else
                                <a href="{{ url('/contact') }}"><label  class="custom-link">Link  </label></a>
                                @endif
                                {{-- <label for="silver">{{ $package->name }}  $ {{ $package->price }}/شهر </label> --}}
                                <label for="silver">{{ $package->content }}  </label>
                            </div>

                            <div class="pkg-box">

                                <p>{{ $package->downloads }}
                                    تحميل عدد ملفات صوتية  <span><i class="fa-solid fa-circle-check"></i></span></p>

                                @foreach ($package->package_detail as $detail)
                                    <p>{{ $detail->package_content->description }}
                                            @if($detail->status == 0)
                                            <span class="default-text">
                                                 <i class="fa-solid fa-circle-xmark"></i>
                                            </span>
                                            @else
                                            <span class="primary-text">
                                                <i class="fa-solid fa-circle-check"></i>
                                            </span>
                                            @endif
                                    </p>
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
                                     @if (Auth::user())
                        {{-- <div id="paypal-button-container"></div> --}}
                        <div class="col-lg-12 text-center my-5">

                            <button
                                @if ($modal == 0) type="submit" @else type="button" onclick="packagemodal()" @endif
                                class="custom-btn primary-btn">تأكيد الشراء</button>
                        </div>
                    @endif
                            <div class="col-lg-12 sign-up text-center mt-5">

                                <p><span class="sign-up-li"><i class="fa-solid fa-circle-check"></i></span> تأمين الدفع</p>
                                <div class="payment-img">
                                    <img src="{{ asset('frontend/images/payments.jpg') }}">

                                </div>
                            </div>
                        </div>
                    </div>

            </form>

        </div>
    </div>

    </div>


    <div class="package-bottom-section " >

        {{-- <h2 class="title">للطلبات الخاصة </h2>
        <p>موسيقى ومؤثرات صوتية خاصة</p>
        <p> مع رخصة امتلاك حقوق ملكية الاصوات</p>
        <div class="py-5 text-center">
            <a href="{{ url('/contact') }}" class="custom-btn primary-btn"> للطلبات هنا </a>
        </div> --}}
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
            if (value != 1) {
                $('#package-modal').modal('show');
            } else {
                packageselect();
            }
        }
    </script>
@endpush
