@extends('layouts.master')

@section('title', trans('messages.order'))
@section('content')
    <div class="container">
        @if (auth()->check())
            @include('order.order_choices')
        @else
            <p>
                {{ trans('messages.login_before_order') }}:
                <a href="{{ route('login', ['next' => route('order')]) }}">{{ trans('messages.login') }}</a>
            </p>
        @endif
    </div>
@stop
