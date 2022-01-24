<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class InputTypeTest extends TestCase
{
	public function test_checkbox_input_type_helper(): void
	{
		$checkbox = $this->aire()->form()->checkbox();
		
		$this->assertSelectorAttribute($checkbox, 'input', 'type', 'checkbox');
	}
	
	public function test_color_input_type_helper(): void
	{
		$color = $this->aire()->form()->color();
		
		$this->assertSelectorAttribute($color, 'input', 'type', 'color');
	}
	
	public function test_date_input_type_helper(): void
	{
		$date = $this->aire()->form()->date();
		
		$this->assertSelectorAttribute($date, 'input', 'type', 'date');
	}
	
	public function test_datetime_input_type_helper(): void
	{
		$datetime = $this->aire()->form()->dateTime();
		
		$this->assertSelectorAttribute($datetime, 'input', 'type', 'datetime');
	}
	
	public function test_date_time_local_input_type_helper(): void
	{
		$datetime = $this->aire()->form()->dateTimeLocal();
		
		$this->assertSelectorAttribute($datetime, 'input', 'type', 'datetime-local');
	}
	
	public function test_email_input_type_helper(): void
	{
		$email = $this->aire()->form()->email();
		
		$this->assertSelectorAttribute($email, 'input', 'type', 'email');
	}
	
	public function test_file_input_type_helper(): void
	{
		$file = $this->aire()->form()->file();
		
		$this->assertSelectorAttribute($file, 'input', 'type', 'file');
	}
	
	public function test_image_input_type_helper(): void
	{
		$image = $this->aire()->form()->image();
		
		$this->assertSelectorAttribute($image, 'input', 'type', 'image');
	}
	
	public function test_month_input_type_helper(): void
	{
		$month = $this->aire()->form()->month();
		
		$this->assertSelectorAttribute($month, 'input', 'type', 'month');
	}
	
	public function test_number_input_type_helper(): void
	{
		$number = $this->aire()->form()->number();
		
		$this->assertSelectorAttribute($number, 'input', 'type', 'number');
	}
	
	public function test_password_input_type_helper(): void
	{
		$password = $this->aire()->form()->password();
		
		$this->assertSelectorAttribute($password, 'input', 'type', 'password');
	}
	
	public function test_range_input_type_helper(): void
	{
		$range = $this->aire()->form()->range();
		
		$this->assertSelectorAttribute($range, 'input', 'type', 'range');
	}
	
	public function test_search_input_type_helper(): void
	{
		$search = $this->aire()->form()->search();
		
		$this->assertSelectorAttribute($search, 'input', 'type', 'search');
	}
	
	public function test_tel_input_type_helper(): void
	{
		$tel = $this->aire()->form()->tel();
		
		$this->assertSelectorAttribute($tel, 'input', 'type', 'tel');
	}
	
	public function test_time_input_type_helper(): void
	{
		$time = $this->aire()->form()->time();
		
		$this->assertSelectorAttribute($time, 'input', 'type', 'time');
	}
	
	public function test_url_input_type_helper(): void
	{
		$url = $this->aire()->form()->url();
		
		$this->assertSelectorAttribute($url, 'input', 'type', 'url');
	}
	
	public function test_week_input_type_helper(): void
	{
		$week = $this->aire()->form()->week();
		
		$this->assertSelectorAttribute($week, 'input', 'type', 'week');
	}
}
