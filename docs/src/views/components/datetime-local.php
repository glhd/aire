<?php

echo e(Aire::dateTimeLocal('dt', 'Pick a Date & Time')
	->helpText('While Aire does support the "datetime" type as well, "datetime-local" is recommended for better localization support.'));
