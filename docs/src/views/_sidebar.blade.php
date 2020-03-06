<div class="hidden lg:block">
	<a href="{{ url('/') }}">
		@include('_logo')
	</a>
</div>

<div class="lg:hidden mt-6 pt-6 border-t border-salmon">
	<h2 class="text-2xl text-salmon mt-0">
		Menu
	</h2>
</div>

<ul class="list-reset mt-8 font-semibold">
	
	<li class="group mb-4 lg:hidden">
		<i class="fas fa-fw fa-arrow-up mr-2 text-gray-600 group-hover:text-gray-700"></i>
		<a href="#" class="text-gray-700 no-underline hover:text-gray-900">
			Back to top of page
		</a>
	</li>
	
	<?php
	$main = [
		['/', 'README', 'file'],
		['api', 'API Overview', 'code'],
		['working-with-elements', 'Working w/ Elements', 'layer-group'],
		// ['scaffolding', 'Scaffolding Forms', 'hammer'],
		['alpine-components', 'Alpine.js', 'fab fa-js-square'],
		['components', 'Components', 'cubes'],
		['themes', 'Theming', 'paint-roller'],
	];
	?>
	
	@include('_menu-items', ['menu' => $main])

</ul>

<div class="font-bold -mb-3 mt-6 pt-6 border-t border-gray-300 text-gray-500 text-sm">
	Recipes
</div>

<ul class="list-reset mt-8 font-semibold">
	
	<?php
	$recipes = [
		['basic', 'Basic Demo', 'file-code'],
		['validation', 'Client-Side Validation', 'file-code'],
		['html-buttons', 'HTML in Buttons', 'file-code'],
	];
	?>
	
	@include('_menu-items', ['menu' => $recipes])

</ul>

<div class="font-bold -mb-3 mt-6 pt-6 border-t border-gray-300 text-gray-500 text-sm">
	Themes
</div>

<ul class="list-reset mt-8 font-semibold">
	
	<?php
	$themes = [
		['tailwind-custom-forms', 'Tailwind Forms', 'fill-drip'],
		['bootstrap', 'Bootstrap', 'fab fa-bootstrap'],
	];
	?>
	
	@include('_menu-items', ['menu' => $themes])

</ul>

<ul class="list-reset mt-8 font-semibold">
	<li class="group mb-6 mt-6 pt-6 border-t border-gray-300">
		<i class="fab fa-fw fa-github mr-2 text-gray-600 group-hover:text-gray-700"></i>
		<a href="https://github.com/glhd/aire" class="text-gray-700 no-underline hover:text-gray-900" target="_blank">
			Aire on Github
			<i class="fas fa-external-link-alt text-white group-hover:text-gray-100 ml-1"></i>
		</a>
	</li>
</ul>
