@foreach($menu as $item)
	
	<?php
	[$path, $label, $icon] = $item;
	$icon_class = preg_match('/^fa[sb]\b/', $icon)
		? $icon
		: "fas fa-{$icon}";
	?>
	
	@if($current_path === $path)
		
		<li class="group text-salmon mb-4">
			<i class="fa-fw {{ $icon_class }} mr-2"></i>
			<a href="{{ url($path) }}" class="text-salmon font-bold no-underline cursor-default">
				{{ $label }}
			</a>
		</li>
	
	@else
		
		<li class="group mb-4">
			<i class="fa-fw {{ $icon_class }} mr-2 text-gray-600 group-hover:text-gray-700"></i>
			<a href="{{ url($path) }}" class="text-gray-700 no-underline hover:text-gray-900">
				{{ $label }}
			</a>
		</li>
	
	@endif

@endforeach
