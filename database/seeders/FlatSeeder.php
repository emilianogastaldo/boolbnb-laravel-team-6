<?php

namespace Database\Seeders;

use App\Models\Flat;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flats = [
            [
                'title' => 'Appartamento elegante in zona residenziale',
                'description' => 'Splendido appartamento completamente arredato in una zona tranquilla e ben collegata.',
                'address' => 'Via del Corso, 00186 Roma RM',
                'bed' => 3,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 110,
                'latitude' => 41.8919300,
                'longitude' =>  12.5113300,
                'image' => 'flat_img/appartamento1.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento moderno con terrazza panoramica',
                'description' => 'Appartamento di design con una spaziosa terrazza da cui si gode una vista mozzafiato sulla città.',
                'address' => 'Piazza di Spagna, 00187 Roma, RM',
                'bed' => 2,
                'room' => 2,
                'bathroom' => 1,
                'sq_m' => 90,
                'latitude' => 41.9064800,
                'longitude' => 12.4823200,
                'image' => 'flat_img/appartamento2.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento accogliente vicino al centro storico',
                'description' => 'Accogliente appartamento situato a pochi passi dal centro storico, ideale per una coppia o una piccola famiglia.',
                'address' => 'Via Condotti, 00187 Roma RM',
                'bed' => 1,
                'room' => 2,
                'bathroom' => 1,
                'sq_m' => 60,
                'latitude' =>  41.9064800,
                'longitude' =>  12.4823200,
                'image' => 'flat_img/appartamento3.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento luminoso con giardino privato',
                'description' => 'Appartamento luminoso e spazioso con un bellissimo giardino privato, perfetto per chi ama la tranquillità.',
                'address' => 'Piazza Navona, 00186 Roma RM',
                'bed' => 4,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 130,
                'latitude' => 41.8991700,
                'longitude' => 12.4730600,
                'image' => 'flat_img/appartamento4.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento di lusso nel cuore della città',
                'description' => 'Elegante appartamento di lusso situato nel centro storico della città, con servizi di alta qualità e finiture di pregio.',
                'address' => 'Viale Trastevere, 00153 Roma RM',
                'bed' => 2,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 100,
                'latitude' => 41.8797200,
                'longitude' => 12.4694400,
                'image' => 'flat_img/appartamento5.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento con vista sul parco',
                'description' => 'Appartamento con affaccio sul verde di un tranquillo parco cittadino, ideale per chi ama la natura e la tranquillità.',
                'address' => 'Via Appia Antica, 00179 Roma RM',
                'bed' => 3,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 95,
                'latitude' =>  41.8733300,
                'longitude' => 12.5158300,
                'image' => 'flat_img/appartamento6.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento ristrutturato con stile',
                'description' => 'Appartamento completamente ristrutturato con stile e attenzione ai dettagli, situato in una zona ben servita e tranquilla.',
                'address' => 'Piazza Venezia, 00186 Roma RM',
                'bed' => 2,
                'room' => 2,
                'bathroom' => 1,
                'sq_m' => 75,
                'latitude' => 41.8955600,
                'longitude' => 12.4822200,
                'image' => 'flat_img/appartamento7.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento con terrazza e vista sul fiume',
                'description' => 'Appartamento con una grande terrazza da cui si gode una magnifica vista sul fiume, ideale per serate estive.',
                'address' => 'Via Veneto, 00187 Roma RM',
                'bed' => 3,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 110,
                'latitude' => 41.9064800,
                'longitude' => 12.4823200,
                'image' => 'flat_img/appartamento8.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento spazioso con cucina moderna',
                'description' => 'Ampio appartamento con una cucina moderna e ben attrezzata, ideale per chi ama cucinare e ricevere ospiti.',
                'address' => 'Piazza del Popolo, 00187 Roma RM',
                'bed' => 4,
                'room' => 2,
                'bathroom' => 3,
                'sq_m' => 150,
                'latitude' => 41.9100000,
                'longitude' => 12.4761100,
                'image' => 'flat_img/appartamento9.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento con vista panoramica sulla città',
                'description' => 'Appartamento situato in una posizione privilegiata con una vista panoramica sulla città, luminoso e ben ventilato.',
                'address' => 'Via dei Fori Imperiali, 00186 Roma RM',
                'bed' => 2,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 85,
                'latitude' => 41.8927800,
                'longitude' => 12.4858300,
                'image' => 'flat_images/48UndcDkyPskQGM051s7PdpGitIzSw3RxaD1UWuz.jpg',
                'is_visible' => true,
            ],
        ];

        $user_ids = User::pluck('id')->toArray();

        $services_ids = Service::pluck('id')->toArray();

        foreach ($flats as $flat) {
            $new_flat = new Flat();
            $new_flat->fill($flat);
            $new_flat->user_id = Arr::random($user_ids);
            $new_flat->slug = Str::slug($flat['title']);
            $new_flat->save();

            $flat_services = array_filter($services_ids, fn () => rand(0, 1));
            $new_flat->services()->attach($flat_services);
        }
    }
}
