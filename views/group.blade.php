<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<div {{ $attributes->except('class') }} class="{{ $class }}" data-aire-group>
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
	
	@isset($help_text)
		<small class="{{ config('aire.default_classes.group_help_text') }}" data-aire-help-text>
			{{ $help_text }}
		</small>
	@endisset
	
	@if(isset($errors) && count($errors))
		<ul class="list-reset" data-aire-errors>
			
			@foreach($errors as $error)
				
				<li class="block mt-1 text-red text-sm font-normal">
					{{ $error }}
				</li>
				
			@endforeach
			
		</ul>
	@endif
</div>
