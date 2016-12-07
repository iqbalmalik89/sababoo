<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 20/08/2016
 * Time: 1:46 PM
 */
?>
@extends('frontend.layouts.master')

@section('title', 'Payment Failur')

@section('content')

<div class="breadcrumb-wrapper">

				<div class="container">

					<ol class="breadcrumb-list">
						<li><a href="/home">Home</a></li>
						<li><span>Payment Failure</span></li>
					</ol>

				</div>

			</div>
			<!-- end hero-header -->

			<div class="error-page-wrapper">

				<div class="container">

					<div class="row">

						<div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">

							<h3>Failure!</h3>

							<p>Sorry! your payment has not been successfully made.</p>


							<a href="/home" class="btn btn-primary mt-15">Back to home page</a>

						</div>

					</div>

				</div>
    </div>

@endsection

<?php

?>