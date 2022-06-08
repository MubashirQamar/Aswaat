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
        <p class="message-text">You are redirect to home page please wait</p>

        <a href="{{ url('/home') }}" class="custom-btn secondary-btn"> BACK TO HOME </a>

    </div>

</main>
@endsection
