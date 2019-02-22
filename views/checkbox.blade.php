<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>

<label {{ $attributes->label }}>
	<input {{ $attributes }} />
	<span {{ $attributes->wrapper }}>
		{{ $label_text }}
	</span>
</label>
