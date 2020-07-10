<?php

use Illuminate\Database\Seeder;

//inicio
use App\permisos\models\IdentificationsType;

class tipoIdentificionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $identification=IdentificationsType::where('name','Cédula de ciudadania')->first();
        if ($identification) {
          $identification->delete();
        }
        $identification=IdentificationsType::create([
          'name' => 'Cédula de ciudadania',
          'description' => 'Certificado de nacionalidad',
        ]);
    }
}
