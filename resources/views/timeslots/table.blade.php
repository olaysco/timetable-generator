<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <table class="table table-bordered">
            <thead>
                <tr class="table-head">
                    <th>Day</th>
                    <th>Timeslots</th>
                    <th style="width: 10%"></th>
                </tr>
            </thead>
            @foreach ($days as $day)
                @if (count($day->timeslots))
                    <tr>
                        <td rowspan="{{ count($day->timeslots) }}">{{ $day->name }}</td>
                        <td>{{ $day->timeslots[0]->time }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm resource-update-btn" data-id="{{ $day->timeslots[0]->id }}"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-sm resource-delete-btn" data-id="{{ $day->timeslots[0]->id }}"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                    @for($i = 1; $i < count($day->timeslots); $i++)
                        <tr>
                            <td>{{ $day->timeslots[$i]->time }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm resource-update-btn" data-id="{{ $day->timeslots[$i]->id }}"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btn-sm resource-delete-btn" data-id="{{ $day->timeslots[$i]->id }}"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    @endfor
                @else
                    <tr>
                        <td>{{ $day->name }}</td>
                        <td colspan="2">No timeslots added</td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</div>



