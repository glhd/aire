<div class="mb-6 {{ $class ?? '' }}">
	{{ $label ?? '' }}
	
	<div class="{{ $prepend || $append ? 'flex' : '' }}">
		@if($prepend)
			<div class="-mr-1 block p-2 text-base leading-normal bg-grey-100 text-grey-300 border rounded-l-sm">
				{{ $prepend }}
			</div>
		@endif
		
		{{ $element }}
			
			@if($append)
				<div class="-ml-1 block p-2 text-base leading-normal bg-grey-100 text-grey-300 border rounded-r-sm">
					{{ $append }}
				</div>
			@endif
	</div>
	
	@isset($help_text)
		<small class="block mt-1 text-grey-dark text-sm font-normal">
			{{ $help_text }}
		</small>
	@endisset
</div>
