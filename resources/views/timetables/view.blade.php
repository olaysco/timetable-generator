<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ $timetableName }}</title>
        <link href="{!! URL::asset('/vendors/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">

         <style>

            body {
                font-family:  Tahoma, Geneva, Verdana, sans-serif;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            .table-head {
                text-transform:uppercase;
                text-align: center;
                color: #000000;
            }

            td {
                border: 1px solid #000000;
                font-size: 0.8em;
                height: 60px;
                text-align: center;
            }

            .table-head td {
                height: 40px;
            }

            .course_code {
                font-weight: bold;
                font-size: 1.5em;
            }

            .room {
                float: left;
                margin-top: 20px;
                margin-bottom: 10px;
                font-size: 0.8em;
            }

            .professor {
                float: right;
                margin-top: 20px;
                margin-bottom: 10px;
                font-size: 0.8em;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {!! $timetableData !!}
                </div>
            </div>
        </div>
    </body>
</html>
