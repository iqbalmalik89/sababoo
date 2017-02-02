<div id="msg_request_modal" class="modal fade in login-box-wrapper" tabindex="-1" data-width="550" style="display:none; margin-top:-10%;" data-backdrop="static" data-keyboard="false" data-replace="true">
    <input type="hidden" name="hidden_reciever_id" id="hidden_reciever_id" value="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="dismissModal($('#msg_request_modal'));">&times;</button>
        <h4 class="modal-title text-center">Message Request</h4>
    </div>

    <div id="msg_request_div" class="alert" style="display:none;"></div>

    <div class="modal-body">
        <div class="row gap-20">


            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="request_message" id="request_message"></textarea>

                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer text-center">
        <img class="button_spinners" style="display:none; margin-left: 137px; margin-bottom: -30px;" src="{{URL::to('pannel/images/loader.gif')}}" id="submit_loader">
        <button type="button" class="btn btn-primary" onclick="sendMessageRequest()">Send Request</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse" onclick="dismissModal($('#msg_request_modal'));">Cancel</button>
    </div>

</div>