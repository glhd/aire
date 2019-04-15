<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>
<?php /** @var \Galahad\Aire\Support\OptionsCollection $options */ ?>

<select {{ $attributes->except('value') }}>
	
	@foreach($options->getOptions() as $value => $label)
		
		<option value="{{ $value }}" {{ $attributes->isValue($value) ? 'selected' : '' }}>
			{{ $label }}
		</option>
	
	@endforeach

</select>
