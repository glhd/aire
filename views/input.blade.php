<?php /** @var \Galahad\Aire\Elements\Attributes $attributes */ ?>

<input
	{{ $attributes->excluding('class') }}
	class="block w-full p-2 text-base leading-normal  {{ $class ?? '' }}"
/>
