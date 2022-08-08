<?php

namespace Galahad\Aire\Tests\Unit;

use Illuminate\Database\Eloquent\Model;

class EnumModelStub extends Model
{
	protected $guarded = [];
	
	protected $casts = [
		'name' => Names::class,
	];
}

enum Names: string
{
	case CM = 'Chris';
	
	case TE = 'Tim';
}
