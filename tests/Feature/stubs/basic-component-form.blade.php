

<x-aire::form id="test_form">
	
	<x-aire::summary verbose />
	
	<x-aire::input 
		name="generic_input" 
		label="Generic Input"
		id="generic_input"
		group-id="generic_input_group"
		help-text="Sample help text"
		required
	/>
	
	<x-aire::select
		:options="['a' => 'a', 'b' => 'b']"
		name="basic_select"
		label="Basic Select"
		id="basic_select"
	/>
	
	<x-aire::select
		:options="['a' => 'a', 'b' => 'b']"
		name="multi_select"
		label="Multi-Select"
		id="multi_select"
		multiple
	/>
	
	<x-aire::text-area
		name="text_area"
		label="Text Area"
		id="text_area"
	/>
	
	<x-aire::file
		name="file_input"
		label="File Input"
		id="file_input"
	/>
	
	<x-aire::range
		name="range_input"
		label="Range Input"
		min="20"
		max="30"
		id="range_input"
	/>
	
	<x-aire::checkbox
		name="checkbox"
		label="Checkbox"
		id="checkbox"
	/>
	
	<x-aire::radio-group
		:options="['a' => 'eh', 'b' => 'bee']"
		name="radio_group"
		label="Radio Group"
		id="radio_group"
	/>
	
	<x-aire::checkbox-group
		:options="['a' => 'eh', 'b' => 'bee']"
		name="checkbox_group"
		label="Checkbox Group"
		id="checkbox_group"
	/>
	
	<x-aire::submit 
		label="Submit Button"
		id="submit"
	/>
	
</x-aire::form>
