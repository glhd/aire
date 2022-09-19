<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>

<label {{ $attributes }}>
	@if (substr($for,-strlen('_r'))==='_r')
		{{ $text ?? '' }} (<span class="text-red-500">*</span>)
	@else
		{{ $text ?? '' }}
	@endif
</label>
