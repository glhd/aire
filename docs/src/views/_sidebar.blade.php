<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 204.07 130.44" width="180">
	<title>aire</title>
	<g>
		<path d="M75.5,126h196a4,4,0,0,1,4,4v35a4,4,0,0,1-4,4H75.5a4,4,0,0,1-4-4V130A4,4,0,0,1,75.5,126Z" transform="translate(-71.43 -86.06)" style="fill: #f4645f;fill-rule: evenodd"/>
		<path d="M75.5,126h196a4,4,0,0,1,4,4v35a4,4,0,0,1-4,4H75.5a4,4,0,0,1-4-4V130A4,4,0,0,1,75.5,126Z" transform="translate(-71.43 -86.06)" style="fill: #f4645f;fill-rule: evenodd"/>
		<path d="M79.5,131h188c2.21,0,3,.79,3,3v27c0,2.21-.79,3-3,3H79.5c-2.21,0-3-.79-3-3V134C76.5,131.79,77.29,131,79.5,131Z" transform="translate(-71.43 -86.06)" style="fill: #f4645f;fill-rule: evenodd"/>
		<path d="M80.5,131h186a4,4,0,0,1,4,4v25a4,4,0,0,1-4,4H80.5a4,4,0,0,1-4-4V135A4,4,0,0,1,80.5,131Z" transform="translate(-71.43 -86.06)" style="fill: #fff;fill-rule: evenodd"/>
		<path d="M75.5,173.5h126a4,4,0,0,1,4,4v35a4,4,0,0,1-4,4H75.5a4,4,0,0,1-4-4v-35A4,4,0,0,1,75.5,173.5Z" transform="translate(-71.43 -86.06)" style="fill: #f4645f;fill-rule: evenodd"/>
		<path d="M82.69,118.49l-2-.84-.88-1.49,1.25-4H91.9L93,115.88l-.75,1.91-2.46.7v3.11h14.56v-3.25l-3-1.12L92.09,89.09H83.71l-9.35,28.19-2.93,1.07v3.25H82.69Zm1.86-17.63,1.35-6H87l1.35,6,2.24,7.25H82.27Z" transform="translate(-71.43 -86.06)" style="fill: #f4645f"/>
		<path d="M111.62,93.78a3.87,3.87,0,1,0-4.14-3.86A3.91,3.91,0,0,0,111.62,93.78ZM105.3,121.6h13.35v-2.83l-2.14-.47-1.07-2v-19H105.3v2.84l2.37.46,1.07,2V116.3l-1.07,2-2.37.47Z" transform="translate(-71.43 -86.06)" style="fill: #f4645f"/>
		<path d="M134.7,118.77l-2.47-.47-1.07-2v-6.37a8.65,8.65,0,0,1,3.72-7.49l2.28,2.46c2.42.14,5-1.35,5-4.37a3.74,3.74,0,0,0-3.91-3.81c-2.47,0-4.93,2.14-7.21,7.86l-.37-.19.46-5.91V97.32h-10v2.84l2.23.46,1.07,2V116.3l-1.07,2-2.23.47v2.83H134.7Z" transform="translate(-71.43 -86.06)" style="fill: #f4645f"/>
		<path d="M165.12,118.86l-1.35-2.7A16.73,16.73,0,0,1,157,118c-4.09,0-6.19-2.19-6.56-7.22h15.17v-1.48c0-7.4-3.4-12.7-10.47-12.7-6.84,0-11.86,5.62-11.86,13.25,0,7.17,4.37,12.52,11.86,12.52A17.6,17.6,0,0,0,165.12,118.86ZM154.61,99.79c2.88,0,3.81,2.79,3.91,8h-8.15C150.51,102.34,152,99.79,154.61,99.79Z" transform="translate(-71.43 -86.06)" style="fill: #f4645f"/>
	</g>
</svg>

<ul class="list-reset mt-8 font-semibold">
	
	<?php
	$main = [
		['/', 'README', 'file'],
		['api', 'API Overview', 'code'],
		['customizing', 'Customizing', 'paint-brush'],
		['themes', 'Theming', 'paint-roller'],
	];
	?>
	
	@include('_menu-items', ['menu' => $main])

</ul>

<div class="font-bold -mb-3 mt-6 pt-6 border-t border-grey-lighter text-grey text-sm">
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
	
	<li class="group mb-6 mt-6 pt-6 border-t border-grey-lighter">
		<i class="fab fa-fw fa-github mr-2 text-grey-dark group-hover:text-grey-darker"></i>
		<a href="https://github.com/glhd/aire" class="text-grey-darker no-underline hover:text-grey-darkest" target="_blank">
			Aire on Github
			<i class="fas fa-external-link-alt text-white group-hover:text-grey-light ml-1"></i>
		</a>
	</li>
	
</ul>
