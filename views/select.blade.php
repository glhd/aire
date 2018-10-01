<?php /** @var \Galahad\Aire\Elements\Attributes $attributes */ ?>

<select {{ $attributes->excluding('class') }}>
	{{ $options ?? null }}
</select>
