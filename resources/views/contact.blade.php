@extends('layouts.app')

@section('content')
    <main>
        @if (session()->get('msg'))

        <div class="sign-up contact-section text-center" id="contactsec2"  >

            <h2 class="title">وسائل التواصل</h2>

            <p> Your details have been submitted successfully. </p>
            <p> One of our sales representative will get touch with you shortly. </p>

        </div>
        @endif
        <div class="sign-up contact-section" id="contactsec1"   @if (session()->get('msg')) style="display:none"   @endif>




            <h2 class="title">وسائل التواصل</h2>

            <form method="POST" action="{{ route('contact') }}">
                @csrf
                <div class="form-group">
                    <label for="name">الاسم:</label>
                    <input id="name" name="name" required autocomplete="off" autofocus type="text">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="c_name">اسم الشركة:</label>
                    <input id="c_name" name="c_name" required autocomplete="off" autofocus type="text">
                    @error('c_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="city">المدينة:</label>
                    <input id="city" name="city" required autocomplete="off" autofocus type="text">
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country">البلد:</label>
                    <input id="country" name="country" required autocomplete="off" autofocus type="text">
                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="p_number">رقم المحمول:</label>
                    <input id="p_number" name="p_number" required autocomplete="off" autofocus type="text">
                    @error('p_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">عنوان البريد الالكتروني:</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="off">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>



                <div class="button-group">
                    <button class="custom-btn primary-btn"> ارسال </button>
                </div>

            </form>

        </div>
        {{-- <hr class="contact-hr"> --}}
        <div class="sign-up  contact-info-section">

            <div class="contact-box">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-phone contact-icon">
                        <span class="fix-editor">&nbsp;</span></i>
                    <p> +966 59 505 8885 </p>
                </div>
            </div>
            <div class="contact-box">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-envelope contact-icon">
                        <span class="fix-editor">&nbsp;</span></i>
                    <p> talabat@awwat.com </p>
                </div>
            </div>
            <div class="contact-box">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-location-dot contact-icon"></i>
                    {{-- <i class="fa-solid fa-location-dot "> --}}
                        {{-- <span class="fix-editor">&nbsp;</span></i> --}}
                        <p> مبنى الفهد 1 - مكتب 19 </p>
                        <p> حي محمد بن سعود   ، الدمام ، المملكة العربية السعودية </p>
                </div>

            </div>
        </div>
    </main>
@endsection
@push('include-js')
@if (session()->get('msg'))
<script>
    setTimeout(() => {
        $('#contactsec1').css('display','block');
     $('#contactsec2').css('display','none');

 }, 5000);
</script>
@endif
@endpush
