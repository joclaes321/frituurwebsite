@extends('layouts.master')

@section('title', 'Login')
@section('content')
    <!-- Marketing messaging and featurettes
			================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container">
        <form class="form-horizontal" role="form" method="post" action="{{ route('attempt_login') }}">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">{{ trans('messages.email') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="{{ trans('messages.email') }}"
                           value="">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">{{ trans('messages.password') }}</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="{{ trans('messages.password') }}"
                           value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <input id="submit" name="submit" type="submit" value="Inloggen" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
@stop
