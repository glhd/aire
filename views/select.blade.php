<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<select {{ $attributes->except('value', 'class') }} class="block w-full p-2 leading-normal border rounded-sm bg-white appearance-none {{ $class }}">
	
	@foreach($options as $value => $label)
		
		<option value="{{ $value }}" {{ $attributes->isValue($value) ? 'selected' : '' }}>
			{{ $label }}
		</option>
		
	@endforeach
	
</select>
