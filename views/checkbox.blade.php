<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<label {!! isset($attributes['id']) ? "for=\"{$attributes['id']}\"" : '' !!}>
	<input
		{{ $attributes->except('class') }}
		class="block w-full p-2 text-base leading-normal {{ $class }}"
	/>
	{{ $checkbox_label ?? '' }}
</label>
