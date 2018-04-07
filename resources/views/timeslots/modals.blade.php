<!-- Modal for adding a new room -->
<div class="modal custom-modal" id="resource-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4 class="modal-heading">Add New Timeslot</h4>
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
                                <label>Time</label>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="select2-wrapper">
                                            <select id="from-select" name="from" class="form-control select2">
                                                @for($i = 0; $i <= 23; $i++)
                                                   @foreach(['00', '30'] as $subPart)
                                                    <option value="{{ (($i < 10) ? "0" : "") . $i . ":" . $subPart }}">
                                                        {{ (($i < 10) ? "0" : "") . $i . ":" . $subPart }}
                                                    </option>
                                                    @endforeach
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="select2-wrapper">
                                            <select id="to-select" name="to" class="form-control select2">
                                                @for($i = 0; $i <= 23; $i++)
                                                    @foreach(['00', '30'] as $subPart)
                                                    <option value="{{ (($i < 10) ? "0" : "") . $i . ":" . $subPart }}">
                                                        {{ (($i < 10) ? "0" : "") . $i . ":" . $subPart }}
                                                    </option>
                                                    @endforeach
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
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