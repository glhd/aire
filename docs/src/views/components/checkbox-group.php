<?php

echo e(Aire::checkboxGroup([1 => 'One', 2 => 'Two', 3 => 'Three'], 'radio', 'Checkboxes')
	->value([2, 3]));
