<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Styles -->
		@include('partials.styles')
		@yield('styles')

		<title>Activate Account | Timetable</title>
    </head>

    <body class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-8  col-md-offset-4 col-sm-offset-2">
                    <div id="activation-form-container">
                        <div class="login-form-header">
                            <h3 class="text-center">timetable</h3>
                        </div>

                        <div class="login-form-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <form method="POST" action="{{ URL::to('/users/activate') }}">
                                        {!! csrf_field() !!}
                                        @include('errors.form_errors')

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $user->name }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                        </div>

                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" placeholder="Password" name="password_confirmation">
                                        </div>

                                        <div class="form-group">
                                            <label>Security Question</label>

                                            <div class="select2-wrapper">
                                                <select name="security_question_id" class="form-control select2">
                                                    @foreach ($questions as $question)
                                                    <option value="{{ $question->id }}">{{ $question->question }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Your Answer</label>
                                            <input type="text" class="form-control" name="security_question_answer">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" name="submit" value="ACTIVATE ACCOUNT" class="btn btn-lg btn-block btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        @include('partials.scripts')
        @yield('scripts')
    </body>
</html>