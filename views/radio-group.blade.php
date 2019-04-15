<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>
<?php /** @var \Galahad\Aire\Support\OptionsCollection $options */ ?>

<div {{ $attributes->wrapper }}>
	@foreach($options->getOptions() as $option_value => $option_label)
		
		<label {{ $attributes->label }}>
			<input
				{{ $attributes->except('id', 'value', 'checked') }}
				value="{{ $option_value }}"
				{{ $attributes->isValue($option_value) ? 'checked' : '' }}
			/>
			<span {{ $attributes->label_wrapper }}>
				{{ $option_label }}
			</span>
		</label>
	
	@endforeach
</div>
