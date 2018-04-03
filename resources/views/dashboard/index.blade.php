@extends('layouts.app')

@section('content')
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 page-container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-title">
            <h1><span class="fa fa-dashboard"></span> Dashboard</h1>
        </div>
    </div>

    <div class="page-body menubar" id="resource-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row cards-container">
                    <?php $count = 1; ?>
                    @foreach ($data['cards'] as $card)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card card-{{ $count++ }}">
                            <div class="card-title">
                                <span class="pull-right icon fa fa-{{$card['icon'] }}"></span>
                                <h3>{{ $card['title'] }}</h3>
                            </div>

                            <div class="card-body">
                                <span>{{ $card['value'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('courses.modals')
@endsection

@section('scripts')
<script src="{{URL::asset('/js/courses/index.js')}}"></script>
@endsection