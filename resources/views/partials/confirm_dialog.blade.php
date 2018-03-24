<div class="modal" id="confirm-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="resource-delete-form" class='delete-form'>
            {{ method_field('DELETE') }}
            {{ csrf_field() }}

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4 id="delete-dialog-header"></h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                        <p id="delete-message"></p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <button type="button" class="cancel btn btn-default btn-block" data-dismiss="modal" id="no-button">No</button>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <button type="submit" class="submit btn btn-danger btn-block" id="yes-button">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>