<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<select {{ $attributes }}>
	
	@foreach($options as $value => $label)
		
		<option value="{{ $value }}">
			{{ $label }}
		</option>
		
	@endforeach
	
</select>
