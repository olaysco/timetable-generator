<!-- Modal for adding a new room -->
<div class="modal custom-modal" id="resource-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4 class="modal-heading">Add New Lecture Room</h4>
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
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Courses</label>

                                <div class="select2-wrapper">
                                    <select id="courses-select" name="course_ids[]" class="form-control select2" multiple>
                                        <option value="">Select courses</option>
                                        @foreach ($courses as $course)
                                         <option value="{{ $course->id }}">{{ $course->course_code }} {{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Unavailable periods</label>

                                <div class="select2-wrapper">
                                    <select id="periods-select" name="unavailable_periods[]" class="form-control select2" multiple>
                                        <option value="">Select unavailable periods for this lecturer</option>
                                        @foreach ($days as $day)
                                            @foreach ($timeslots as $timeslot)
                                                <option value="{{ $day->id  }},{{ $timeslot->id }}">
                                                    {{ $day->name . " " . $timeslot->time }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
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