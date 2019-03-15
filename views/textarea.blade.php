<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<textarea {{ $attributes->except('value') }}>{{ $attributes->get('value') }}</textarea>
