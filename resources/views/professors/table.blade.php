<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @if (count($professors))
        <table class="table table-bordered">
            <thead>
                <tr class="table-head">
                    <th style="width: 50%">Name</th>
                    <th style="width: 40%">Courses Taught</th>
                    <th>Unavailable Periods</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($professors as $professor)
                <tr>
                    <td>{{ $professor->name }}</td>
                    <td>
                        @if (count($professor->courses))
                            <ul>
                                @foreach ($professor->courses as $course)
                                <li>{{ $course->course_code . " " . $course->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No courses added yet</p>
                        @endif
                    </td>
                    <td>
                        @if (count($professor->unavailable_periods))
                            <ul>
                                @foreach ($professor->unavailable_periods as $period)
                                    <li>{{ $period->day->name . " " . $period->timeslot->time }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No unavailable periods</p>
                        @endif
                    </td>
                    <td>
                    <button class="btn btn-primary btn-sm resource-update-btn" data-id="{{ $professor->id }}"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm resource-delete-btn" data-id="{{ $professor->id }}"><i class="fa fa-trash-o"></i></button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
         <div id="pagination">
            {!!
                $professors->render()
            !!}
        </div>
        @else
        <div class="no-data text-center">
            <p>No professors added yet</p>
        </div>
        @endif
    </div>
</div>