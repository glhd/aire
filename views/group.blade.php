<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>

<div {{ $attributes }}>
	{{ $label }}
	
	@isset($info_text)
		<div {{ $attributes->info_text }}>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<circle cx="12" cy="12" r="10"></circle>
				<line x1="12" y1="16" x2="12" y2="12"></line>
				<line x1="12" y1="8" x2="12.01" y2="8"></line>
			</svg>
			<div class="absolute bottom-0 flex flex-col items-center hidden mb-6 group-hover:flex">
				<span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-gray-700 rounded shadow-lg">{!! $info_text !!}</span>
				<div class="w-3 h-3 -mt-2 rotate-45 bg-gray-700"></div>
			</div>
        </div>
	@endisset
	
	<div class="{{ $prepend || $append ? 'flex' : '' }}">
		@if($prepend)
			<div {{ $attributes->prepend }}>
				{!! $prepend !!}
			</div>
		@endif
		
		{{ $element }}
			
		@if($append)
			<div {{ $attributes->append }}>
				{!! $append !!}
			</div>
		@endif
	</div>
	
	<ul {{ $attributes->errors }}>
		@each($error_view, $errors, 'error')
	</ul>
	
	@isset($help_text)
		<small {{ $attributes->help_text }}>
			{{ $help_text }}
		</small>
	@endisset
	
</div>
