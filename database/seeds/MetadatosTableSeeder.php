<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Metadato;

class MetadatosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Metadato::create([
            'seccion' => 'home',
            'keywords' => "home",
            'description' => "home",
        ]);

        Metadato::create([
            'seccion' => 'empresa',
            'keywords' => "empresa",
            'description' => "empresa",
        ]);

        Metadato::create([
            'seccion' => 'servicios',
            'keywords' => "servicios",
            'description' => "servicios",
        ]);

        Metadato::create([
            'seccion' => 'productos',
            'keywords' => "productos",
            'description' => "productos",
        ]);

        Metadato::create([
            'seccion' => 'proyectos',
            'keywords' => "proyectos",
            'description' => "proyectos",
        ]);

        Metadato::create([
            'seccion' => 'clientes',
            'keywords' => "clientes",
            'description' => "clientes",
        ]);

        Metadato::create([
            'seccion' => 'sectores',
            'keywords' => "sectores",
            'description' => "sectores",
        ]);

        Metadato::create([
            'seccion' => 'presupuesto',
            'keywords' => "presupuesto",
            'description' => "presupuesto",
        ]);

        Metadato::create([
            'seccion' => 'contacto',
            'keywords' => "contacto",
            'description' => "contacto",
        ]);;
    }
}
