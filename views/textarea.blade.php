<?php /** @var \Galahad\Aire\Elements\Attributes $attributes */ ?>

<textarea {{ $attributes->excluding('class', 'value') }}
	 class="h-auto block w-full p-2 text-base leading-normal text-grey-darkest
		bg-white border rounded-sm {{ $class ?? '' }}">{{ $attributes['value'] ?? null }}</textarea>
