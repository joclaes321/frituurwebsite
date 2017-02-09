@extends('layouts.master')

@section('title', trans('messages.opening_hours'))
@section('content')
    <div class="container demo-bg">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="business-hours">
                    <h2 class="title">Opening Hours</h2>
                    <ul class="list-unstyled opening-hours">
                        <li id="mon">Maandag <span class="pull-right">16u30-22u00</span></li>
                        <li id="tue">Dinsdag <span class="pull-right">16u30-22u00</span></li>
                        <li id="wed">Woensdag <span class="pull-right">11u30-13u30 en 16u30-22u00</span></li>
                        <li id="thu">Donderdag <span class="pull-right">11u30-13u30 en 16u30-22u00</span></li>
                        <li id="fri">Vrijdag <span class="pull-right">11u30-13u30 en 16u30-22u00</span></li>
                        <li id="sat">Zaterdag <span class="pull-right">11u30-13u30 en 16u30-22u00</span></li>
                        <li id="sun">Zondag <span class="pull-right">11u30-13u30 en 16u30-22u00</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

