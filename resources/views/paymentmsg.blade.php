@extends('layouts.app')

@section('content')

<main>

    <div class="main-section" style="justify-content: space-evenly">
        @if ($message = Session::get('success'))
        <h2 class="title">{!! $message !!}</h2>
        <?php Session::forget('success'); ?>
        @endif
        @if ($message = Session::get('error'))
        <h2 class="title">{!! $message !!}</h2>
        <?php Session::forget('error'); ?>
        @endif
        <p class="message-text"> يتم إعادة توجيهك إلى الصفحة الرئيسية نرجوا الإنتظار. </p>

        <a href="{{ url('/home') }}" class="custom-btn secondary-btn"> العودة للخلف </a>

    </div>

</main>
@endsection
