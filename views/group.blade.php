<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<div {{ $attributes }}>
	{{ $label ?? '' }}
	
	<div class="{{ $prepend || $append ? 'flex' : '' }}">
		@if($prepend)
			<div class="{{ config('aire.default_classes.group_prepend') }}">
				{{ $prepend }}
			</div>
		@endif
		
		{{ $element }}
			
		@if($append)
			<div class="{{ config('aire.default_classes.group_append') }}">
				{{ $append }}
			</div>
		@endif
	</div>
	
	<ul class="list-reset mt-2 mb-3 {{ count($errors) ? '' : 'hidden' }}" data-aire-errors>
		@each($error_view, $errors, 'error')
	</ul>
	
	@isset($help_text)
		<small class="{{ config('aire.default_classes.group_help_text') }}" data-aire-help-text>
			{{ $help_text }}
		</small>
	@endisset
	
</div>
