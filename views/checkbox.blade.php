<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<label {{ $label_attributes }}>
	<input {{ $attributes }} />
	<span {{ $components->wrapper }}>
		{{ $checkbox_label ?? '' }}
	</span>
</label>
