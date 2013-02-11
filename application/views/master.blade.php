<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Mon Épicerie</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('css/bootstrap.min.css') }}
</head>
<body>
	<div class="wrapper">
		@yield('background')
 
		@section('nav')
			<nav>
			</nav>
		@yield_section
		
		<div class="container">
			@yield('container')
		</div>

		<footer>
			@yield('footer')
		</footer>
	</div>
</body>
</html>
