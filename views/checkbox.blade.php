<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<label class="flex items-center" {!! isset($attributes['id']) ? "for=\"{$attributes['id']}\"" : '' !!}>
	<input
		{{ $attributes->except('class') }}
		class="{{ $class }}"
	/>
	<span class="ml-2 flex-1">
		{{ $checkbox_label ?? '' }}
	</span>
</label>
