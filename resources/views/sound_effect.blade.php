@extends('layouts.app')

@section('content')
    <main>
        <section class="sound-section" style="background-image: url({{ asset('frontend/images/Banner01.jpg') }})"
            id="home">



            <!--begin container -->

            <div class="container h-80">



                <!--begin row -->

                <div class="row align-items-center h-100">



                </div>

                <!--end row -->



            </div>

            <!--end container -->



        </section>
        <div class="main-section sound-effect">



            <div class="container">

                <div class="row">





                    @foreach($sound as $song)
                    <div class="col-lg-4 box-sound">
                        <a class="cat-link" href="{{ url('/album/'.$song->id) }}">
                        <div class="inner">
                          <img src="{{ asset('assets/images/subcategory/'.$song->image) }}"  alt="">
                            <span class="sound-cat-name">
                               {{ $song->name }}
                            </span>
                           </div></a>

                    </div>
                    @endforeach






                </div>

            </div>

    </main>
@endsection
