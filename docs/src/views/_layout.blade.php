<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	
	<title>
		Aire - {{ $title ?? 'Documentation & Demos' }}
	</title>
	
	<link rel="stylesheet" href="{{ asset('aire.css') }}" />
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/solid.css" integrity="sha384-uKQOWcYZKOuKmpYpvT0xCFAs/wE157X5Ua3H5onoRAOCNkJAMX/6QF0iXGGQV9cP" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/brands.css" integrity="sha384-BCEeiNUiLzxxoeYaIu7jJqq0aVVz2O2Ig4WbWEmRQ2Dx/AAxNV1wMDBXyyrxw1Zd" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/fontawesome.css" integrity="sha384-HU5rcgG/yUrsDGWsVACclYdzdCcn5yU8V/3V84zSrPDHwZEdjykadlgI6RHrxGrJ" crossorigin="anonymous" />
</head>

<body class="font-sans antialiased">

<div class="container mx-auto my-8 flex flex-col sm:flex-row-reverse">
	
	<div class="flex-1 border-l border-grey-lighter pl-16 text-grey-darkest">
		@yield('content')
	</div>
	
	<div class="flex-no-shrink pr-16">
		@include('_sidebar')
	</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-markup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-markup-templating.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-clike.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-php-extras.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-javascript.min.js"></script>

</body>

</html>
