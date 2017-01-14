@extends('frontend.layouts.master')

@section('title', 'Contact Us')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing')


@section('content')
                                
    <div class="row">
    
        @include('frontend.site.contactus_content')
        
    </div>
	
    
<script type="text/javascript" src="js/infobox.js"></script>
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
                $('#subject').val('');
                return;
            }
        }

</script>

<script>
    var mapIcon = $('#map_icon').val();
      var customLabel = {
        S: {
          label: 'S'
        }
      };

        function initMap() {
          var centerLatitude = $('#map').attr('data-lat');
          var centerLongitude = $('#map').attr('data-lon');
          var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(centerLatitude, centerLongitude),
            zoom: 2
          });

          var icon = new google.maps.MarkerImage(mapIcon,

                       new google.maps.Size(32, 46), new google.maps.Point(0, 0),

                       new google.maps.Point(16, 32));

        var infoWindow = new google.maps.InfoWindow;

        }


    </script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API_KEY', 'AIzaSyDVin53mLiAbmi16hNdmuOWepWnbJuZoDQ')}}&callback=initMap">
    </script>

@endsection