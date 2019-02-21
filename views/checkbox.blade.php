<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<label class="flex items-center" @isset($label_for)for="{{ $label_for }}"@endisset>
	<input {{ $attributes }} />
	<span class="ml-2 flex-1">
		{{ $checkbox_label ?? '' }}
	</span>
</label>
