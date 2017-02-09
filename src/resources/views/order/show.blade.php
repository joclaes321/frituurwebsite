@extends('layouts.master')

@section('title', 'order')
@section('content')
    <div class="container">
        <h2>Bestelling</h2>

        @if (Session::has('message'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                    {{ Session::get('message') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3"><strong>bestelling</strong></div>
            <div class="col-md-2"><strong>aantal</strong></div>
            <div class="col-md-2"><strong>totaal</strong></div>
        </div>
        @foreach ($order->items as $item)
            <div class="row">
                <form action="{{ route('update_order') }}" class="form" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <input type="hidden" name="order_item_id" value="{{ $item->id }}"/>
                    <div class="col-md-3">
                        {{ $item->product->name }} {{ $item->topping ? '+ ' . $item->topping->name : ''  }}
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" value="{{ $item->quantity }}" name="quantity"
                               placeholder="hoeveelheid"/>
                    </div>
                    <div class="col-md-2">
                        &euro; {{ $item->price }}
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="aanpassen" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        @endforeach

        <form action="{{ route('send_order') }}" method="post">
            {{ csrf_field() }}

            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="row">
                <hr>
                <div class="col-md-2 col-md-offset-5">
                    <strong>Totaal: &euro; {{ $order->price }}</strong>
                </div>
                <div class="col-md-2">
                    <input type="submit" value="Verstuur order" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
@stop
