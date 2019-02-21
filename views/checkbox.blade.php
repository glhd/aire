<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<label {{ $label_attributes }}>
	<input {{ $attributes }} />
	<span class="ml-2 flex-1">
		{{ $checkbox_label ?? '' }}
	</span>
</label>
