@extends('layouts.app')

@section('title')
Professors
@endsection

@section('content')
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 page-container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-title">
            <h1><span class="fa fa-graduation-cap"></span> Professors</h1>
        </div>
    </div>

    <div class="menubar">
        <div class="row">
            <div class="col-md-2 col-sm-6 col-xs-12 col-md-offset-10 col-sm-offset-6">
                <button class="btn btn-md btn-primary btn-block" id="resource-add-button"><span class="fa fa-plus"></span> Add New Professor</button>
            </div>
        </div>
    </div>

    <div class="page-body" id="resource-container">
        @include('professors.table')
    </div>
</div>

@include('professors.modals')
@endsection

@section('scripts')
<script src="{{URL::asset('/js/professors/index.js')}}"></script>
@endsection