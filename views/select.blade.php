<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<select {{ $attributes->except('value') }}>
	
	@foreach($options as $value => $label)
		
		<option value="{{ $value }}" {{ (is_array($attributes['value']) && in_array($value, $attributes['value'])) || $value === $attributes['value'] ? 'selected' : '' }}>
			{{ $label }}
		</option>
		
	@endforeach
	
</select>
