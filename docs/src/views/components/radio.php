<?php

echo e(Aire::radioGroup([1 => 'One', 2 => 'Two', 3 => 'Three'], 'radio', 'Radio Group')
	->value(2));
