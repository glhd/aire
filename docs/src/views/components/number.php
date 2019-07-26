<?php

echo e(Aire::number('num', 'Enter a number divisible by 10')
	->value(100)
	->step(10));
