<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @if (count($classes))
        <table class="table table-bordered">
            <thead>
                <tr class="table-head">
                    <th style="width: 30%">Name</th>
                    <th style="width: 10%">Size</th>
                    <th style="width: 30%">Courses</th>
                    <th style="width: 20%">Unavailable Rooms</th>
                    <th style="width: 10%">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($classes as $class)
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->size }}</td>
                    <td>
                        @foreach ($academicPeriods as $period)
                            {{ $period->name }}
                            <?php $courses = $class->courses()->wherePivot('academic_period_id', $period->id)->get(); ?>
                            @if (count($courses))
                            <ul>
                            @foreach ($courses as $course)
                                <li>{{ $course->course_code . " " . $course->name }}</li>
                            @endforeach
                            </ul>
                            @else
                            <p>No courses added for this period</p>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if (count($class->unavailable_rooms))
                        <ul>
                            @foreach ($class->unavailable_rooms as $room)
                                <li>{{ $room->name }}</li>
                            @endforeach
                        </ul>
                        @else
                        None specified
                        @endif
                    </td>
                    <td>
                    <button class="btn btn-primary btn-sm resource-update-btn" data-id="{{ $class->id }}"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm resource-delete-btn" data-id="{{ $class->id }}"><i class="fa fa-trash-o"></i></button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
         <div id="pagination">
            {!!
                $classes->render()
            !!}
        </div>
        @else
        <div class="no-data text-center">
            <p>No matching data was found</p>
        </div>
        @endif
    </div>
</div>