<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<noscript>
	<textarea {{ $attributes->except('value') }}>{{ $attributes->get('value') }}</textarea>
</noscript>
<script>
document.write({!! json_encode('<div style="display:none;"><textarea '.$attributes->except('value').'>'.$attributes->get('value').'</textarea></div>') !!});
</script>
