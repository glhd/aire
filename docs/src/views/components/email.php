<?php

echo e(Aire::month('email', 'Enter Your Email')
	->pattern('^.*@gmail\\.com$')
	->helpText('Must be valid and end in gmail.com'));
