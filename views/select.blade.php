<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<select {{ $attributes->except('value', 'class') }} class="block w-full p-2 leading-normal border rounded-sm bg-white appearance-none {{ $class }}">
	
	@foreach($options as $value => $label)
		
		<option value="{{ $value }}" {{ (is_array($attributes['value']) && in_array($value, $attributes['value'])) || $value === $attributes['value'] ? 'selected' : '' }}>
			{{ $label }}
		</option>
		
	@endforeach
	
</select>
