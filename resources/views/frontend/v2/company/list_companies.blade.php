@extends('frontend.v2.layouts.inside')

@section('title', 'Companies')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing')


@section('content')

    @include('frontend.v2.company.company_content')

@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
  getCompanies(1);
});
</script> 
@endsection

