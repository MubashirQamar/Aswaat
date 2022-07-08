@extends('layouts.app')

@section('content')
    <section>

        <div class="container-fluid profil" style="height: auto">

            <div class="profile-cart">
                <h2>Checkout</h2>
            </div>

            <div class="row cart-tables">
                @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('success');?>
                @endif

                @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif
                <div class="col-lg-8 table-responsive">

                    <table>

                        <tbody>
                            @php
                                $total = 0;
                                $name = "";
                            @endphp
                            @if (session('package'))
                                @foreach (session('package') as $id => $details)
                                    @php
                                        $total += $details['price'];
                                        $name = $details['name'];
                                    @endphp
                                    <tr data-id="{{ $id }}">
                                        <td>
                                            <p>Package {{  $details['name'] }}</p>
                                        </td>

                                        <td><strong> $. {{ $details['price'] }}</strong></td>

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
                                    $. {{ $total  }}
                                </td>
                            </tr>




                        </tbody>

                    </table>

                </div>
                <form action="{{ route('paypal') }}" method="post" >
                    @csrf
                    <div class="col-lg-12 text-end my-5">
                        <input type="hidden" name="desc"  value="Buy a Package of {{ $name }}">
                        <input type="hidden" name="amount"  value="{{ $total }}">
                        <button type="submit" class="custom-btn primary-btn">ﺷراء ﻣﻊ ي ﺑﺎ ل ﺑﺎ </button>

                    </div>
                </form>





            </div>


        </div>


        <!-- Modal -->


    </section>
@endsection

