<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	
	<title>
		Aire - {{ $title ?? 'Documentation & Demos' }}
	</title>
	
	<link href="{{ App::isLocal() ? asset('tailwind.css') : 'https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css' }}" rel="stylesheet" />
</head>

<body class="bg-grey-lightest font-sans antialiased">

<div class="container mx-auto my-8 flex flex-col sm:flex-row-reverse">
	
	<div class="flex-1 rounded border bg-white p-4 shadow-md">
		@yield('content')
	</div>
	
	@include('_sidebar')

</div>

</body>

</html>
