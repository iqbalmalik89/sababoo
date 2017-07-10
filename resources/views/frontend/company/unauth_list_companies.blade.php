@extends('frontend.layouts.unathenticate')

@section('title', 'Companies')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing')


@section('content')

        <!-- start Main Wrapper -->
<div class="main-wrapper">

    @include('frontend.company.company_content')
</div>

<script>

    $(document).ready(function () {

    });
</script>
@endsection

