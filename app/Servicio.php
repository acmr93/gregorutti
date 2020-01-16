<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Servicio extends Model
{
    use HasTranslations;
    
    protected $table = 'servicios';
    protected $fillable = [
							'orden',
							'titulo',
							'texto',
                            'img',
							'icon',
						];

    public $translatable = ['titulo'];

    protected $casts = [
        'img' => 'array',
        'texto' => 'array',
        'icon' => 'array',
    ];
}
