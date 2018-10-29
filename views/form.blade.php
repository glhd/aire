<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<form {{ $attributes }}>

	@if(isset($_token) && 'GET' !== $method)
		<input type="hidden" name="_token" value="{{ $_token }}" />
	@endif
	
	@isset($_method)
		<input type="hidden" name="_method" value="{{ $_method }}" />
	@endisset
	
	{{ $fields ?? '' }}
	
	@if($validate && $inline_validation)
		
		<script>{!! file_get_contents($validation_src) !!}</script>
		
	@elseif($validate && $validation_script_path)
		
		<script src="{{ $validation_script_path }}" async></script>
		
	@endif
	
</form>
