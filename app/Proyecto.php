<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Proyecto extends Model
{
	use HasTranslations;
    
    protected $table = 'categorias';
    protected $fillable = [
							'orden',
							'titulo',
                            'img',
							'texto',
                            'slug'
						];

    public $translatable = ['titulo',];

	protected $casts = [
        'img' => 'array',
        'texto' => 'array',
    ];
}
