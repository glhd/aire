<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<select {{ $attributes->except('value') }}>
	
	@foreach($options as $value => $label)
		
		<option value="{{ $value }}" {{ $attributes->isValue($value) ? 'selected' : '' }}>
			{{ $label }}
		</option>
		
	@endforeach
	
</select>
