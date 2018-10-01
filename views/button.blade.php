<?php /** @var \Galahad\Aire\Elements\Attributes $attributes */ ?>

<button
	{{ $attributes->except('class') }}
	class="inline-block font-normal text-center whitespace-no-wrap align-middle select-none border
		rounded font-normal leading-normal text-white bg-blue-dark border-blue-darker
		hover:bg-blue-darker hover:border-blue-darkest
		p-2 px-4 {{ $class }}"
>

	{{ $label ?? null }}
	
</button>
