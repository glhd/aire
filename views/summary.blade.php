<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>
<?php /** @var string $error_bag */ ?>
<?php /** @var \Illuminate\Support\ViewErrorBag $errors */ ?>

@if (isset($errors) && $errors instanceof \Illuminate\Support\ViewErrorBag && $errors->getBag($error_bag)->any())
	
	<div {{ $attributes }}>
		
		{{ trans_choice('aire::common.summary', $errors->getBag($error_bag)->count()) }}
		
		@if($verbose)
			
			<ul class="pt-4">
				@foreach ($errors->getBag($error_bag)->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			
		@endif
		
	</div>
	
@endif
