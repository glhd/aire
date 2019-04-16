<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>
<?php /** @var \Galahad\Aire\Support\OptionsCollection $options */ ?>

<select {{ $attributes->except('value') }}>
	
	@isset($prepend_empty_option)
		<option value="{{ $prepend_empty_option->value }}" {{ $attributes->isValue($prepend_empty_option->value) ? 'selected' : '' }}>
			{{ $prepend_empty_option->label }}
		</option>
	@endisset
	
	@foreach($options->getOptions() as $value => $label)
		
		<option value="{{ $value }}" {{ $attributes->isValue($value) ? 'selected' : '' }}>
			{{ $label }}
		</option>
	
	@endforeach

</select>
