<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<label {!! isset($attributes['id']) ? "for=\"{$attributes['id']}\"" : '' !!}>
	<input
		{{ $attributes->except('class') }}
		class="{{ $class }}"
	/>
	{{ $checkbox_label ?? '' }}
</label>
