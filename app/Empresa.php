<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Empresa extends Model
{
    use HasTranslations;
    protected $table = 'empresa';
    protected $fillable = [
    						'nombre',
							'domicilio',
							'ubicacion_maps',
							'enlance_maps',
							'email_contacto',
							'email_presupuesto',
							'redes_sociales',
							'telefonos',
							'emails',
                            'terminos',
                            'texto_secciones',
							'contenido_home'
						];
    public $translatable = ['terminos'];

    protected $casts = [
        'domicilio' => 'array',
        'redes_sociales' => 'array',
        'telefonos' => 'array',
        'emails' => 'array',
        'texto_secciones' => 'array',
        'contenido_home' => 'array'
    ];
}