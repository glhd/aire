<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<input
	{{ $attributes->except('class') }}
	class="block w-full p-2 text-base leading-normal {{ $class }}"
/>
