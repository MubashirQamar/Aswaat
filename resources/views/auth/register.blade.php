@extends('layouts.app')

@section('content')
    <main>

        <div class="sign-up main-section sign-up-section">

            <h2 class="title">تسجيل جديد</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">الاسم الشخصي:</label>
                    <input id="name" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus
                        type="text">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">البريد الالكتروني:</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="off">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">الرقم السري:</label>
                    <input id="password" type="password" name="password" required autocomplete="off">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm" style="">تأكيد الرقم السري:</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="off">

                </div>

                <div class="form-group form-check custom-check">
                    <input type="checkbox" class="form-check-input" required id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1"> <a href="{{ url('/terms') }}" target="_blank"> أوافق على هذه الشروط والأحكام</a></label>
                  </div>
                <div class="button-group">
                    <button class="custom-btn primary-btn"> المتابعة </button>
                </div>

            </form>
            <div class="sign-up bottom-section">
                <h2 class="title">ابدأ في التسجيل مجانًا!</h2>

                    <p class="align-left"> مع حساب مجاني يمكنك. </p>

                    <ul class="menu-list-inner">

                        <li> تحميل الموسيقى والمؤثرات الصوتية <span class="sign-up-li"><i class="fa-solid fa-circle-check"></i></span></li>
                        <li> قئمة المفضلة  <span class="sign-up-li"><i class="fa-solid fa-circle-check"></i></span></li>
                        <li> شراء الموسيقى <span class="sign-up-li"><i class="fa-solid fa-circle-check"></i></span></li>



                    </ul>

            </div>
        </div>

    </main>

    {{-- <div class="container" style="display: none">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
