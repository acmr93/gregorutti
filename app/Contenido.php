<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Contenido extends Model
{
	use HasTranslations;

    protected $table = 'contenido';
    protected $fillable = [
							'seccion',
							'orden',
							'titulo',
							'subtitulo',
							'texto1',
							'texto2',
							'img',
							'slug',
							'proyecto_id'
						];

    public $translatable = ['titulo','subtitulo', 'texto1', 'texto2'];

    protected $casts = [
        'img' => 'array',
    ];

    public function proyecto()
    {
    	return $this->belongsTo('App\Proyecto','proyecto_id');
    }
}
