<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<label {{ $components->label }}>
	<input {{ $attributes }} />
	<span {{ $components->wrapper }}>
		{{ $checkbox_label ?? '' }}
	</span>
</label>
