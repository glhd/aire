@foreach($menu as $item)
	
	<?php [$path, $label, $icon] = $item; ?>
	
	@if($current_path === trim($path, '/'))
		
		<li class="group text-salmon mb-6">
			<i class="fas fa-fw fa-{{ $icon }} mr-2"></i>
			<a href="{{ url($path) }}" class="text-salmon font-bold no-underline cursor-default">
				{{ $label }}
			</a>
		</li>
	
	@else
		
		<li class="group mb-6">
			<i class="fas fa-fw fa-{{ $icon }} mr-2 text-grey-dark group-hover:text-grey-darker"></i>
			<a href="{{ url($path) }}" class="text-grey-darker no-underline hover:text-grey-darkest">
				{{ $label }}
			</a>
		</li>
	
	@endif

@endforeach
