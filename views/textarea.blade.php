<textarea {{ aire_attributes($attributes, ['value', 'class']) }}
	 class="h-auto block w-full p-2 text-base leading-normal text-grey-darkest
		bg-white border rounded-sm {{ $class ?? '' }}">{{ $attributes['value'] ?? null }}</textarea>
