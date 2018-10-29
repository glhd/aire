<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	
	<title>
		Aire Documentation &amp; Demos
	</title>
	
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body>

	<div class="container mx-auto my-8">
		
		<div class="my-8">
			
			<h2 class="mb-8">
				Basic Form Example
			</h2>

			{{ Aire::open() }}
			
			{{ Aire::input()
				->label('Demo Input')
				->id('demo')
				->helpText('This is demo help text.') }}
			
			{{ Aire::textarea()->value('Demo text area') }}
			
			{{ Aire::button('Demo Button') }}
			
			{{ Aire::close() }}
		
		</div>
	
	</div>

</body>

</html>
