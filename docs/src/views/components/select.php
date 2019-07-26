<?php

echo e(Aire::select([1 => 'One', 2 => 'Two', 3 => 'Three'], 'select', 'Select')
	->value(2));

echo e(Aire::select([1 => 'One', 2 => 'Two', 3 => 'Three'], 'select2', 'Multi-Select')
	->multiple()
	->value([2, 3]));
