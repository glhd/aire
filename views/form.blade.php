<form {{ aire_attributes($attributes) }}>

	@if(isset($_token) && 'GET' !== $method)
		<input type="hidden" name="_token" value="{{ $_token }}" />
	@endif
	
	@isset($_method)
		<input type="hidden" name="_method" value="{{ $_method }}" />
	@endisset
	
	{{ $fields ?? '' }}
	
</form>
