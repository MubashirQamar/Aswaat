@extends('layouts.app')

@section('content')
    <main>

        <div class="sign-up contact-section">

            <h2 class="title">Contact Us</h2>

            <form method="POST" action="#">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input id="name" name="name" required autocomplete="off" autofocus type="text">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="c_name">Company Name:</label>
                    <input id="c_name" name="c_name" required autocomplete="off" autofocus type="text">
                    @error('c_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input id="city" name="city" required autocomplete="off" autofocus type="text">
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input id="country" name="country" required autocomplete="off" autofocus type="text">
                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="p_number">Phone Number:</label>
                    <input id="p_number" name="p_number" required autocomplete="off" autofocus type="text">
                    @error('p_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="off">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>



                <div class="button-group">
                    <button class="custom-btn primary-btn"> Submit </button>
                </div>

            </form>

        </div>
        <hr class="contact-hr">
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
                    <i class="fa-solid fa-location-dot contact-icon">
                        <span class="fix-editor">&nbsp;</span></i>

                </div>
                <p> Al Fahd Building 1 - Office 19 </p>
                <p> Mohammed Bin Saud Dis.,Dammam,Saudia Arabia </p>
            </div>
        </div>
    </main>
@endsection
