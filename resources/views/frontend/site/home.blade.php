
@extends('frontend.layouts.master')

@section('title', 'Welcome To Sababoo')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee')
@section('robots', 'index, follow')
@section('revisit-after', 'content="3 days')
@section('container_class', 'fixedbg')


@section('content')


    @include('frontend.site.home_content')


@endsection
