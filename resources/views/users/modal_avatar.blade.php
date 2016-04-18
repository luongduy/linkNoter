<div class="modal fade" id="modalProfile" tabindex="-1" role="dialog">
    <form id="uploadAvatarForm" action="{{ url('/add-avatar') }}" method="POST" enctype="multipart/form-data">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="pull-right close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="fileupload-buttonbar">
                        <div class="fileinput-button">
                            <div class="preview">
                                <img style="max-width: 500px;max-height: 300px;" src="{{ request()->getBaseUrl()}}/image/cloud.png" />
                            </div>
                            <input class="fileInput" type='file' name='file' value="">
                            <input class="fileName" type='hidden' name='name' value="">
                        </div>

                        <p id="uploadHintText"><b>Drag/drop/click</b> to upload your image</p>
                    </div>

                <div class="modal-options">
                    <div class="modal-options-change" style="display: none;">
                        <a class="modal-options-change-btn">Clear and add another avatar</a>
                    </div>

                    <div class="modal-options-toobig tab-page" style="display: none;">
                        <span class="modal-options-error-message">Your image is too large to upload</span>
                        <span class="modal-options-separator">|</span>
                        <a class="modal-options-cancel" href="#">Cancel</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  data-dismiss="modal" aria-label="Close" class="btn btn-default">Cancel</button>
                <button type="button" class="btn btn-primary submitChangeProfile"><i class="glyphicon glyphicon-save"></i>&nbsp;Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    </form>
</div><!-- /.modal -->