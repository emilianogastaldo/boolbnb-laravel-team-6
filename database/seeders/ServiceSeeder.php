<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Colazione',
                'color' => '#FFCF40',
                'icon' => '<i class="fa-solid fa-mug-saucer"></i>'
            ],
            [
                'name' => 'Piscina',
                'color' => '#0014A8',
                'icon' => '<i class="fa-solid fa-person-swimming"></i>'
                ],
            [
                'name' => 'Wifi',
                'color' => '#007FFF',
                'icon' => '<i class="fa-solid fa-wifi"></i>'
            ],
            [
                'name' => 'Cucina',
                'color' => '#ADFF2F',
                'icon' => '<i class="fa-solid fa-kitchen-set"></i>'
            ],
            [
                'name' => 'Parcheggio',
                'color' => '#1C1C1C',
                'icon' => '<i class="fa-solid fa-square-parking"></i>'
            ],
            [
                'name' => 'Vasca con idromassaggio',
                'color' => '#1C1C1C',
                'icon' => '<i class="fa-solid fa-spa"></i>'
            ],
            [
                'name' => 'Fumatori',
                'color' => '#F80000',
                'icon' => '<i class="fa-solid fa-ban-smoking"></i>'
            ],
            [
                'name' => 'Aria condizionata',
                'color' => '#273BE2',
                'icon' => '<i class="fa-solid fa-snowflake"></i>'
            ],
            [
                'name' => 'Lavatrice',
                'color' => '#39FF14',
                'icon' => '<i class="fa-solid fa-jug-detergent"></i>'
            ],
            [
                'name' => 'Tv',
                'color' => '#343E40',
                'icon' => '<i class="fa-solid fa-tv"></i>'
            ],
            [
                'name' => 'Caminetto',
                'color' => '#A52A2A',
                'icon' => '<i class="fa-solid fa-fire"></i>'
            ],
            [
                'name' => 'Carta igienica',
                'color' => '#B5B8B1',
                'icon' => '<i class="fa-solid fa-toilet-paper"></i>'
            ],
            [
                'name' => 'Shampo e Bagnoschiuma',
                'color' => '#A50B5E',
                'icon' => '<i class="fa-solid fa-pump-soap"></i>'
            ],
            [
                'name' => 'Cassaforte',
                'color' => '#1C1C1C',
                'icon' => '<i class="fa-solid fa-vault"></i>'
            ],
            [
                'name' => 'Estintore',
                'color' => '#E32636',
                'icon' => '<i class="fa-solid fa-fire-extinguisher"></i>'
            ],
            [
                'name' => 'Accesso con Carrozzina',
                'color' => '#91A3B0',
                'icon' => '<i class="fa-solid fa-wheelchair"></i>'
            ],
            [
                'name' => 'Servizio navetta',
                'color' => '#151719',
                'icon' => '<i class="fa-solid fa-van-shuttle"></i>'
            ],
            [
                'name' => 'Feste di compleanni',
                'color' => '#DA1D81',
                'icon' => '<i class="fa-solid fa-cake-candles"></i>'
            ],
            [
                'name' => 'Piano bar',
                'color' => '#480607',
                'icon' => '<i class="fa-solid fa-martini-glass-empty"></i>'
            ],
            [
                'name' => 'Kit Spiaggia',
                'color' => '#FFFF66',
                'icon' => '<i class="fa-solid fa-umbrella-beach"></i>'
            ],
            [
                'name' => 'Zanzariera',
                'color' => '#434B4D',
                'icon' => '<i class="fa-solid fa-mosquito-net"></i>'
            ],
            [
                'name' => 'Asciugacapelli',
                'color' => '#ED3CCA',
                'icon' => '<i class="fa-solid fa-fan"></i>'
            ],
            [
                'name' => 'Postazione di lavoro',
                'color' => '#121910',
                'icon' => '<i class="fa-solid fa-computer"></i>'
            ],
            [
                'name' => 'Manuale della casa',
                'color' => '#606E8C',
                'icon' => '<i class="fa-regular fa-file-lines"></i>'
            ],
            [
                'name' => 'Kit di prontosoccorso',
                'color' => '#C80815',
                'icon' => '<i class="fa-solid fa-kit-medical"></i>'
            ],
        ];
        foreach($services as $service){
            $new_service = new Service();
            $new_service->fill($service);
            $new_service->save();
        }
    }
}
