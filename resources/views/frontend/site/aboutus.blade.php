
@extends('frontend.layouts.master')

@section('title', 'About Us')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee')
@section('robots', 'index, follow')
@section('revisit-after', 'content="3 days')
@section('container_class', 'fixedbg')


@section('content')


    <div class="about-us-wrapper">
        @include('frontend.site.aboutus_content')
    </div>


@endsection
