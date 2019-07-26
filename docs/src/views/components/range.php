<?php

echo e(Aire::range('range', 'Range')
	->min(50)
	->max(100)
	->step(10)
	->value(70));
