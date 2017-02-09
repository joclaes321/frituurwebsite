@extends('layouts.master')

<!-- Marketing messaging and featurettes
    ================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

@section('title', trans('messages.contact'))
@section('content')
<div class="container marketing">
    <form class="form-horizontal" role="form" method="post" action="{{ route('contact_send') }}">
        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Naam</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Voornaam & Achternaam" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="voorbeeld@domein.com" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="subject" class="col-sm-2 control-label">Onderwerp</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Onderwerp" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="col-sm-2 control-label">Bericht</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="4" name="message"></textarea>
            </div>
        </div>
        <!--<div class="form-group">
            <label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
            </div>
        </div>-->
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <! Will be used to display an alert to the user>
            </div>
        </div>
    </form>
</div><!-- /.container -->
@stop
