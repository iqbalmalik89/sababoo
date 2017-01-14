@extends('frontend.layouts.master')

@section('title', 'Contact Us')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing')


@section('content')
                                
    <div class="row contact-us-wrapper">
    
        @include('frontend.site.contactus_content')
        
    </div>
	
<script>    
var pageURI = '';
var request_data = '';
var isScrLock = false;
var html = '';
$(document).ready(function () {
    
    $('#contact_submit').click(function () {
        $('.loader').show();
        html = '';
        pageURI = '/contact-us';
        
        request_data = $('#frm_contact').serializeArray();
        mainAjax('frm_contact', request_data, 'POST',fillData);
   
    });
    
});
    
    function fillData(data){
            $('.loader').hide();
            if (data.code == '200') {
                $('#username').val('');
                $('#email').val('');
                $('#msg').val('');
                return;
            }
        }

</script>
@endsection