<label {{ aire_attributes($attributes, ['class']) }}
	class="inline-block mb-2 {{ isset($for) ? 'cursor-pointer' : '' }} {{ $class ?? '' }}">
	
	{{ $text ?? null }}
</label>
