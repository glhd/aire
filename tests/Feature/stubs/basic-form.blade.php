
{{ Aire::open()->id('test_form') }}

{{ Aire::summary()->verbose() }}

{{ Aire::input('generic_input', 'Generic Input')
	->id('generic_input')
	->groupId('generic_input_group')
	->helpText('Sample help text')
	->required() }}

{{ Aire::select(['a' => 'a', 'b' => 'b'], 'basic_select', 'Single Select')
    ->id('basic_select') }}

{{ Aire::select(['a' => 'a', 'b' => 'b'], 'multi_select', 'Multi-Select')
	->id('multi_select')
	->multiple() }}

{{ Aire::textArea('text_area', 'Text Area')
    ->id('text_area')}}

{{ Aire::file('file_input', 'File Input')
    ->id('file_input') }}

{{ Aire::range('range_input', 'Range Input', 20, 30)
    ->id('range_input') }}

{{ Aire::checkbox('checkbox', 'Checkbox')
    ->id('checkbox') }}

{{ Aire::radioGroup(['a' => 'eh', 'b' => 'bee'], 'radio_group', 'Radio Group')
    ->id('radio_group') }}

{{ Aire::checkboxGroup(['a' => 'eh', 'b' => 'bee'], 'checkbox_group', 'Checkbox Group')
    ->id('checkbox_group') }}

{{ Aire::submit('Submit Button')->id('submit') }}

{{ Aire::close() }}
