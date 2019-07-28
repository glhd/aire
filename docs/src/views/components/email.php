<?php

echo e(Aire::email('email', 'Enter Your Email')
	->pattern('^.*@gmail\\.com$')
	->helpText('Must be valid and end in gmail.com'));
