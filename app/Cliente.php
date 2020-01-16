<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Cliente extends Model
{
    use HasTranslations;
    
    protected $table = 'clientes';
    protected $fillable = [
							'orden',
							'nombre',
							'texo',
							'img',
                            'slug',
                            'url',
						];

    public $translatable = ['nombre'];

    protected $casts = [
        'img' => 'array',
    ];

}
