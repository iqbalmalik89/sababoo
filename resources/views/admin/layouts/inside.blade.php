<?php 
if(isset($title)&&$title!=''){
	$title=$title;
}else{
	$title='Sababoo | Admin';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<title><?php echo $title; ?></title>
<link rel="shortcut icon" href="{{url('assets/frontend/images/ico/favicon.png')}}"/>

@include('admin.common.css')
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
	@include('admin.common.header')
		<!--main content start-->
			@yield('content')
		<!--main content end--> 
	@include('admin.common.footer')
	@include('admin.common.js')
@yield('scripts')
</body>
</html>