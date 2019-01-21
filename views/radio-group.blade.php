<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<div {{ $attributes->only('id') }}>
	@foreach($options as $option_value => $option_label)
		
		<label class="flex items-baseline mb-2 ml-2 border-transparent border-l">
			<input
				{{ $attributes->except('id', 'value', 'checked') }}
				value="{{ $option_value }}"
				{{ $attributes->isValue($option_value) ? 'checked' : '' }}
			/>
			<span class="flex-1 ml-2">
				{{ $option_label }}
			</span>
		</label>
	
	@endforeach
</div>
