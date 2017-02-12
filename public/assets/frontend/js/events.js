$(document).ready(function () {
    
    $('#contact_submit').click(function () {
        $('.loader').show();
        html = '';
        pageURI = '/contact-us';
        
        request_data = $('#frm_contact').serializeArray();
        mainAjax('frm_contact', request_data, 'POST',fillData);
        
         function fillData(data){
            $('.loader').hide();
            if (data.code == '200') {
                $('#username').val('');
                $('#email').val('');
                $('#msg').val('');
                $('#subject').val('');
                return;
            }
        }

    });
    
});
