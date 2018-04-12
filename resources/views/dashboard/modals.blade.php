<!-- Modal for creating a new timetable -->
<div class="modal custom-modal" id="resource-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4 class="modal-heading">Create New Timetables</h4>
            </div>

            <form class="form" method="POST" action="" id="resource-form">
                <input type="hidden" name="_method" value="">
                <div class="modal-body">
                    <div id="errors-container">
                        @include('partials.modal_errors')
                    </div>

                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>Timetable Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Academic Period</label>
                                <div class="select2-wrapper">
                                    <select class="form-control select2" name="academic_period_id">
                                        <option value="" selected>Select an academic period</option>
                                        @foreach ($academicPeriods as $period)
                                        <option value="{{ $period->id }}">{{ $period->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Select Days</label>

                                @foreach ($days as $day)
                                <div class="form-group">
                                    <input name="day_{{ $day->id }}" type="checkbox" for="day_{{ $day->id }}" @if($day->id <= 5) checked @endif>
                                    <label id="day_{{ $day->id }}">{{ $day->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-offset-1 col-md-offset-1">
                                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Cancel</button>
                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <button type="submit" class="submit-btn btn btn-primary btn-block">Add Resource</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>