@extends('frontend.layouts.master')

@section('title', 'Activate Account')

@section('content')
                                
    <div class="row">
    
        <div class="col-md-10 col-md-offset-1">
        
            <div class="row">

                <div class="col-sm-6 col-sm-offset-3">
                
                    <div class="login-box-wrapper">
            
                        <div class="modal-header">
                            <h4 class="modal-title text-center">Activate User</h4>
                        </div>

                        <div class="modal-body">
                                                
                            <div class="row gap-20">
								   
                                <div class="box_head green">Thank You!</div>
                                <p>
                                    <?php if($response['code'] ==200){ ?>
                                    <span id="return_message" class="msg_ok">
                                    <?php echo $response['msg'];?>
                                </span>
                                    <?php } else {?>
                                    <span id="return_message" class="msg_error">
                                        <?php echo $response['msg'];?>
                                </span>
                                    <?php }?>

                                </p>
                </div>
                            </div>

                        </div>

                        <div class="modal-footer text-center">
                            <div class="col-sm-12 col-md-12">
                                    <div class="login-box-box-action">
                                         <a href="/login">Log-in</a>
                                    </div>
                                </div>
                        </div>
                        
                    </div>

                    
                </div>
            
            </div>
            
        </div>
        
    </div>

</style>	
<script>	
var pageURI = '';
var request_data = '';
var isScrLock = false;
var html = '';
$(document).ready(function () {
    //Sign up
    $('#join_now').click(function () {
        html = '';
        pageURI = '/ui/createuser';
        
        request_data = $('#frm_join').serializeArray();
        mainAjax('frm_join', request_data, 'POST',fillData);
        goToByScroll('signup_top');

    });
    
   
    // Press with enter key.
    submit_key('frm_join input', 'btnsignup');
   
});
function fillData(data){
    $('.loader').hide();
    if (data.code != '200') {
        $('#btnsignup').val(html);
        $('#password1').val('');
        $('#password2').val('');
        $('#captcha').val('');
        return;
    }
    $('#frm_join :input').val('');
    $('#agree').attr('checked', false);
    $('#agree').val('yes');
    $('#country option[value="US"]').attr("selected", true);
     $('#msg_frm_join').addClass('msg_full');
    $('#btnsignup').val(html);

}

</script>
@endsection