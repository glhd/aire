<form {{ aire_attributes($attributes) }}>

	@if(isset($token) && 'GET' !== $method)
		<input type="hidden" name="_token" value="{{ $token }}" />
	@endif
	
	@if('GET' !== $method && 'POST' !== $method)
		<input type="hidden" name="_method" value="{{ $method }}" />
	@endif
	
	{{ $fields ?? '' }}
	
</form>
