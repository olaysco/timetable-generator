@extends('layouts.app')

@section('title')
Courses
@endsection

@section('content')
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 page-container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-title">
            <h1><span class="fa fa-home"></span> Courses</h1>
        </div>
    </div>

    <div class="menubar">
        <div class="row">
            <div class="col-md-2 col-sm-6 col-xs-12 col-md-offset-10 col-sm-offset-6">
                <button class="btn btn-md btn-primary btn-block" id="resource-add-button"><span class="fa fa-plus"></span> Add New Course</button>
            </div>
        </div>
    </div>

    <div class="page-body" id="resource-container">
        @include('courses.table')
    </div>
</div>

@include('courses.modals')
@endsection

@section('scripts')
<script src="{{URL::asset('/js/courses/index.js')}}"></script>
@endsection