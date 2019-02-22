<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>

<form {{ $attributes }}>

	@if(isset($_token) && 'GET' !== $method)
		<input type="hidden" name="_token" value="{{ $_token }}" />
	@endif
	
	@isset($_method)
		<input type="hidden" name="_method" value="{{ $_method }}" />
	@endisset
	
	{{ $fields }}
	
	{{ $validation }}
	
</form>
