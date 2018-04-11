@extends('layouts.app')

@section('title')
My Account
@endsection

@section('content')
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 page-container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-title">
            <h1><span class="fa fa-user"></span> My Account</h1>
        </div>
    </div>

    <div class="menubar">
    </div>

    <div class="page-body" id="resource-container">
        <div class="row">
            <div class="col-md-4 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2">
            <form method="POST" action="{{ URL::to('/my_account') }}">
                    {!! csrf_field() !!}
                    @include('errors.form_errors')

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label>Security Question</label>

                        <div class="select2-wrapper">
                            <select name="security_question_id" class="form-control select2">
                                @foreach ($questions as $question)
                                <option value="{{ $question->id }}"
                                    @if ($user->security_question_id == $question->id) selected @endif>{{ $question->question }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Your Answer</label>
                        <input type="text" class="form-control" name="security_question_answer" value="{{ $user->security_question_answer }}">
                    </div>

                     <a href="#" id="password-container-toggle" data-toggle="collapse" data-target="#password-fields" style="text-decoration: none">Password Settings</a>
                    <div id="password-fields" class="collapse">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password_confirmation">
                        </div>

                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" placeholder="Current Password" name="old_password">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" value="UPDATE ACCOUNT" class="btn btn-lg btn-block btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('rooms.modals')
@endsection

@section('scripts')
<script src="{{URL::asset('/js/rooms/index.js')}}"></script>
@endsection