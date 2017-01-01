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
<link rel="shortcut icon" href=""/>

@include('admin.common.css')
</head>
<body class="">
	<div id="wrapper">
	@include('admin.common.header')

    @include('admin.common.sidebar')
		<!--main content start-->
			@yield('content')
		<!--main content end--> 
	</div>
	@include('admin.common.js')
@yield('scripts')
</body>
</html>