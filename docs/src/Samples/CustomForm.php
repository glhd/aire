<?php

namespace Docs\Samples;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\ConfiguresForm;
use Galahad\Aire\Elements\Form;

class CustomForm implements ConfiguresForm
{
	// Use configureForm to set properties on the form object itself
	public function configureForm(Form $form, Aire $aire) : void
	{
		$form->action('/book-demo')
			->patch()
			->rules([
				'title' => 'required|min:5',
				'author' => 'required',
				'edition' => 'nullable|int|min1',
			]);
	}
	
	public function formFields(Aire $aire) : array
	{
		return [
			'title' => $aire->input('title', 'Book Title')
				->placeholder('Enter the book title here'),
			'author' => $aire->input('author', 'Author Name')
				->helpText('Please try to be consistent in the formatting of author names'),
			'edition' => $aire->number('edition', 'Book Edition')
				->groupAddClass('w-48')
				->step(1),
		];
	}
}
