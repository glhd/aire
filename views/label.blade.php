<?php /** @var \Galahad\Aire\Elements\Attributes $attributes */ ?>

<label {{ $attributes->except('class') }}
	class="inline-block mb-2 {{ isset($for) ? 'cursor-pointer' : '' }} {{ $class }}">
	
	{{ $text ?? null }}
</label>
