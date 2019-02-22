<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<div {{ $attributes }}>
	{{ $label ?? '' }}
	
	<div class="{{ $prepend || $append ? 'flex' : '' }}">
		@if($prepend)
			<div {{ $components->prepend }}>
				{{ $prepend }}
			</div>
		@endif
		
		{{ $element }}
			
		@if($append)
			<div {{ $components->append }}>
				{{ $append }}
			</div>
		@endif
	</div>
	
	{{-- FIXME: use mutator for hidden --}}
	<ul class="list-reset mt-2 mb-3 {{ count($errors) ? '' : 'hidden' }}" {{ $components->errors }}>
		@each($error_view, $errors, 'error')
	</ul>
	
	@isset($help_text)
		<small {{ $components->help_text }}>
			{{ $help_text }}
		</small>
	@endisset
	
</div>
