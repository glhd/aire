<?php

echo e(Aire::submit('Standard Button'));

echo e(Aire::submit('Gray Button')->variant()->gray()->addClass('my-1'));
echo e(Aire::submit('Red Button')->variant()->red()->addClass('my-1'));
echo e(Aire::submit('Orange Button')->variant()->orange()->addClass('my-1'));
echo e(Aire::submit('Yellow Button')->variant()->yellow()->addClass('my-1'));
echo e(Aire::submit('Green Button')->variant()->green()->addClass('my-1'));
echo e(Aire::submit('Teal Button')->variant()->teal()->addClass('my-1'));
echo e(Aire::submit('Blue Button')->variant()->blue()->addClass('my-1'));
echo e(Aire::submit('Indigo Button')->variant()->indigo()->addClass('my-1'));
echo e(Aire::submit('Purple Button')->variant()->purple()->addClass('my-1'));
echo e(Aire::submit('Pink Button')->variant()->pink()->addClass('my-1'));

echo '<hr class="my-6" />';

echo e(Aire::submit('Small Green Button')
	->variants('sm', 'green'));
