<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<button
	{{ $attributes->except('class') }}
	class="{{ $class }}"
>

	{{ $slot }}
	
</button>
