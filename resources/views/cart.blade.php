@extends('layouts.app')

@section('content')
    <section>

        <div class="container-fluid profil">

            <div class="profile-cart">
                <h2>CART</h2>
            </div>

            <div class="row cart-tables">

                <div class="col-lg-8 table-responsive">

                    <table>

                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @if (session('cart'))
                                @foreach (session('cart') as $id => $details)
                                    @php
                                        $total += $details['price'];
                                    @endphp
                                    <tr data-id="{{ $id }}">
                                        {{-- <td class="cartimg"><img src="images/song.jpg"></td> --}}
                                        <td>
                                            <p>{{ $details['name'] }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $details['duration'] }}</p>
                                        </td>
                                        <td><strong>SR. {{ $details['price'] }}</strong></td>
                                        <td>
                                            <i class="fa-solid fa-xmark remove-from-cart"></i>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td align="center" colspan="5">No items in cart</td>

                                </tr>
                            @endif

                        </tbody>

                    </table>

                </div>

                <div class="col-lg-4 table-responsive">

                    <table class="cart-total-table">

                        <tbody>
                            <tr>
                                <td nowrap="true">
                                    Total
                                </td>
                                <td nowrap="true" class="pull-right">
                                    SR. {{ Auth::user()->subscription_id == -1 ? $total : '00' }}
                                </td>
                            </tr>
                            @if (Auth::user()->subscription_id == -1)
                                <tr class="">
                                    <td colspan="2" nowrap="true">
                                        <a class="txt-gold " href="{{ url('/packages') }}">Switch to silver/gold
                                            package and save 75%! </a>
                                    </td>
                                </tr>
                            @else
                                {{-- <tr>
                                <td>
                                    <p>Credit Balance Usage</p>
                                </td>
                                <td>
                                    <p>03</p>
                                </td>
                            </tr> --}}

                                <tr>
                                    <td>
                                        <p>Available Download </p>
                                    </td>
                                    <td class="pull-right">
                                        {{ $totals }}
                                    </td>
                                </tr>
                            @endif



                        </tbody>

                    </table>

                </div>
                <form  @if(Auth::user()->subscription_id != -1) action="{{ url('/checkout') }}" @else action="{{ url('/chechout-payment') }}" @endif method="post">
                    {{-- <form   action="{{ url('/checkout') }}"  method="post"> --}}
                    @csrf
                    <div class="col-lg-12 text-end my-5">

                        <input type="hidden" name="desc"  value="Buy Songs">
                        <input type="hidden" name="amount"  value="{{ $total }}">
                        <button type="submit" class="custom-btn primary-btn">Confirm
                            Purchase</button>

                    </div>
                </form>


            </div>


        </div>


        <!-- Modal -->
        <div class="modal fade custom-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">No Downloads Available</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Your download limit has expired.</p>
                        <p>Kindly renew your subscription.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary">Renew</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@push('include-js')

<script>
    var downloadStartTime = setTimeout(function () {
       document.getElementById('downloadLink').click();
    }, 2000);
</script>
@endpush
