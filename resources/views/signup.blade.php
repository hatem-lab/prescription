<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>Validator Signup Form Responsive Widget Template :: w3layouts</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Validator Signup Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements"
	/>
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Meta tag Keywords -->
	<!-- css file -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<!-- //css file -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Cuprum:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //web-fonts -->

</head>

<body>
	<!-- title -->
	<h1>
		<span>D</span>iyaa
		<span>M</span>ohammad
		<span>K</span>oman
	</h1>
	<!-- //title -->
	<!-- content -->
	<div class="sub-main-w3">
        {{ Form::open(array('url' => 'thanks')) }}
        
        {{ Form::label('email' , 'E-Mail Address') }}
        <br>
        {{ Form::text('email') }}
        <br>
        {{ Form::label('jobs' , 'Jobs') }}
        <br>
        {{ Form::select('jobs' , array('programmers' => 'Programmers' , 'networks' => 'Networks')) }}
        <br>
        {{ Form::checkbox('agree' , 'yes') }}
        <br>
        {{ Form::label('comments' , 'Comments') }}
        <br>
        {{ Form::textarea('comments' , '' , array('placeholder' => 'your comments please')) }}
        <br>
        {{ Form::submit('Sginup') }}

        {{ Form::close() }}
	</div>
    <!-- //content -->
    
	<!-- copyright -->
	<div class="footer">
		<p>&copy; 2018 Validator Signup Form. All rights reserved | Design by
			<a href="http://w3layouts.com">W3layouts</a>
		</p>
	</div>
	<!-- //copyright -->

	<!-- Jquery -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<!-- //Jquery -->
	<!-- Jquery -->
	<script src="js/jquery-simple-validator.min.js"></script>
	<!-- //Jquery -->

</body>

</html>