<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $table = 'linea_tiempo';
    protected $fillable = [
    						'epoca',
							'texto'
						];
}
