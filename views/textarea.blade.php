<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<textarea
	{{ $attributes->except('class', 'value') }}
	class="h-auto w-full p-2 text-base leading-normal {{ $class }}">{{ $value ?? null }}</textarea>
