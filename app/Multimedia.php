<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Multimedia extends Model
{
    use HasTranslations;
    protected $table = 'multimedia';
    protected $fillable = [
    						'seccion',
							'tipo',
							'orden',
							'nombre',
							'texto1',
							'texto2'
						];
    public $translatable = ['texto1','texto2'];
}
