<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @if (count($timeslots))
        <table class="table table-bordered">
            <thead>
                <tr class="table-head">
                    <th style="width: 90%">Period</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($timeslots as $timeslot)
                <tr>
                    <td>{{ $timeslot->time }}</td>
                    <td>
                    <button class="btn btn-primary btn-sm resource-update-btn" data-id="{{ $timeslot->id }}"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm resource-delete-btn" data-id="{{ $timeslot->id }}"><i class="fa fa-trash-o"></i></button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data text-center">
            <p>No matching data was found</p>
        </div>
        @endif
    </div>
</div>