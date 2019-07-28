<?php

echo e(Aire::color('color', 'Pick a Color')
	->addClass('w-16 h-16')
	->removeClass('w-full')
	->helpText('Pick a color with the browser-native picker'));
