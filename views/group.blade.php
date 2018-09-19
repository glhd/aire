<div class="m-2 p-2">
	@isset($label)
		<label {{ aire_attributes($label_attributes) }}>
			{{ $label }}
		</label>
	@endisset
	{{ $element }}
</div>
