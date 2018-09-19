<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	
	<title></title>
	
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body>

	<div class="container mx-auto my-8">

		{{ Aire::open() }}
		
		{{ Aire::input()->label('Demo Input') }}
		
		{{ Aire::close() }}
	
	</div>

</body>

</html>
