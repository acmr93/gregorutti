<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Metadato extends Model
{
    use HasTranslations;
    protected $table = 'metadatos';
    protected $fillable = [
							'seccion',
							'keywords',
							'description',
						];
    public $translatable = ['keywords', 'description'];
}
