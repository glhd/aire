<?php

namespace Docs\Samples;

use Galahad\Aire\Aire;
use Illuminate\Database\Eloquent\Model;

/**
 * DocBlock annotations are used to infer field type
 *
 * @property string $name
 */
class Author extends Model
{
	protected $dateFormat = 'Y-m-d H:i:s';
	
	// Standard Laravel $casts are used to infer field type
	protected $casts = [
		'is_favorite' => 'bool',
	];
	
	// $dates are also used to infer field type
	protected $dates = [
		'last_read_at',
	];
	
	// Or you can add a custom function to configure a field to your heart's content
	public function configureGenreFormField(Aire $aire)
	{
		$genres = [
			'cb' => 'Cookbooks',
			'dm' => 'Detective and Mystery',
			'fa' => 'Fantasy',
			'lf' => 'Literary Fiction',
		];
		
		return $aire->select($genres, 'genre', 'Genre Best Known For')
			->defaultValue('lf')
			->addClass('bg-pink-100');
	}
	
	// If you're happy with Aire's inferred field but you need to change the label
	// text you can do so without having to give up all the other magic
	public function getIsFavoriteFormLabel() : string
	{
		return 'This is one of my favorite authors';
	}
}
