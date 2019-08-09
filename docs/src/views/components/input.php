<?php

echo e(Aire::input('input', 'Sample Input')
	->id('sample-input-field')
	->required()
	->type('text')
	->placeholder('Placeholder text')
	->value('Pre-filled with data')
	->helpText('This is a regular input element'));

echo e(Aire::input()->label('Large input')
	->variant()->lg());

echo e(Aire::input()->label('Small Input')
	->variant()->sm());
