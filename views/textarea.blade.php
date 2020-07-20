<?php /** @var \Galahad\Aire\Elements\Attributes\Attributes $attributes */ ?>

<textarea {{ $attributes->except('value') }}>{{ $attributes->get('value') }}</textarea>

@if (isset($auto_size) && $auto_size && $attributes->has('id'))
	<script>
	(function(s, h) {
		try {
			var e = document.getElementById('{{ $attributes->get('id') }}'),
				o = e.offsetHeight - e.clientHeight,
				a = function() {
					e[s][h] = 'auto';
					e[s][h] = e.scrollHeight + o + 'px';
				};
			e.addEventListener('input', a);
			setTimeout(a, 10);
		} catch (e) {
		}
	})('style', 'height');
	</script>
@endif
