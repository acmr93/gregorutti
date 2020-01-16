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
							'nombre',
							'img',
                            'slug'
						];

    public $translatable = ['nombre'];

						
    public function contenido()
    {
        return $this->hasMany('App\Contenido','proyecto_id');
    }
}
