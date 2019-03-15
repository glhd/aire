<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>

<div {{ $attributes }}>
	{{ $label }}
	
	<div class="{{ $prepend || $append ? 'flex' : '' }}">
		@if($prepend)
			<div {{ $attributes->prepend }}>
				{{ $prepend }}
			</div>
		@endif
		
		{{ $element }}
			
		@if($append)
			<div {{ $attributes->append }}>
				{{ $append }}
			</div>
		@endif
	</div>
	
	<ul {{ $attributes->errors }}>
		@each($error_view, $errors, 'error')
	</ul>
	
	@isset($help_text)
		<small {{ $attributes->help_text }}>
			{{ $help_text }}
		</small>
	@endisset
	
</div>
