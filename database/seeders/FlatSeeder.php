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
                'address' => 'Via Bocca di Leone 25, 00187 Roma',
                'bed' => 3,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 110,
                'latitude' => 41.9057042,
                'longitude' =>  12.4802106,
                'image' => 'flat_images/appartamento-elegante-in-zona-residenziale.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento moderno con terrazza panoramica',
                'description' => 'Appartamento di design con una spaziosa terrazza da cui si gode una vista mozzafiato sulla città.',
                'address' => 'Via Sistina 69, 00187 Roma',
                'bed' => 2,
                'room' => 2,
                'bathroom' => 1,
                'sq_m' => 90,
                'latitude' => 41.904047,
                'longitude' => 12.4870262,
                'image' => 'flat_images/appartamento-con-terrazza-e-vista-sul-fiume.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento accogliente vicino al centro storico',
                'description' => 'Accogliente appartamento situato a pochi passi dal centro storico, ideale per una coppia o una piccola famiglia.',
                'address' => 'Via Sebastiano Veniero 8, 00192 Roma',
                'bed' => 1,
                'room' => 2,
                'bathroom' => 1,
                'sq_m' => 60,
                'latitude' =>  41.907855,
                'longitude' =>  12.4552845,
                'image' => 'flat_images/appartamento-con-vista-panoramica-sulla-citta.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento luminoso con giardino privato',
                'description' => 'Appartamento luminoso e spazioso con un bellissimo giardino privato, perfetto per chi ama la tranquillità.',
                'address' => 'Via del Vantaggio 45, 00186 Roma',
                'bed' => 4,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 130,
                'latitude' => 41.9085829,
                'longitude' => 12.4771886,
                'image' => 'flat_images/appartamento-con-vista-sul-parco.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento di lusso nel cuore della città',
                'description' => 'Elegante appartamento di lusso situato nel centro storico della città, con servizi di alta qualità e finiture di pregio.',
                'address' => 'Via Gian Domenico Romagnosi 3, 00196 Roma',
                'bed' => 2,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 100,
                'latitude' => 41.9116618,
                'longitude' => 12.4738449,
                'image' => 'flat_images/appartamento-di-lusso-nel-cuore-della-citta.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento con vista sul parco',
                'description' => 'Appartamento con affaccio sul verde di un tranquillo parco cittadino, ideale per chi ama la natura e la tranquillità.',
                'address' => 'Via Flaminia 48, 00196 Roma',
                'bed' => 3,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 95,
                'latitude' =>  41.925892,
                'longitude' => 12.4700755,
                'image' => 'flat_images/appartamento-elegante-in-zona-residenziale.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento ristrutturato con stile',
                'description' => 'Appartamento completamente ristrutturato con stile e attenzione ai dettagli, situato in una zona ben servita e tranquilla.',
                'address' => 'Lungotevere delle Armi 21, 00195 Roma',
                'bed' => 2,
                'room' => 2,
                'bathroom' => 1,
                'sq_m' => 75,
                'latitude' => 41.9176976,
                'longitude' => 12.469738,
                'image' => 'flat_images/appartamento-luminoso-con-giardino-privato.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento con terrazza e vista sul fiume',
                'description' => 'Appartamento con una grande terrazza da cui si gode una magnifica vista sul fiume, ideale per serate estive.',
                'address' => 'Via dei Gracchi 126, 00192 Roma',
                'bed' => 3,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 110,
                'latitude' => 41.9071272,
                'longitude' => 12.4589493,
                'image' => 'flat_images/appartamento-moderno-con-terrazza-panoramica.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento spazioso con cucina moderna',
                'description' => 'Ampio appartamento con una cucina moderna e ben attrezzata, ideale per chi ama cucinare e ricevere ospiti.',
                'address' => 'Via Tommaso Campanella 3, 00195 Roma',
                'bed' => 4,
                'room' => 2,
                'bathroom' => 3,
                'sq_m' => 150,
                'latitude' => 41.8070093,
                'longitude' => 12.6824391,
                'image' => 'flat_images/appartamento-ristrutturato-con-stile.jpg',
                'is_visible' => true,
            ],
            [
                'title' => 'Appartamento con vista panoramica sulla città',
                'description' => 'Appartamento situato in una posizione privilegiata con una vista panoramica sulla città, luminoso e ben ventilato.',
                'address' => 'Viale delle Milizie 3, 00192 Roma',
                'bed' => 2,
                'room' => 2,
                'bathroom' => 2,
                'sq_m' => 85,
                'latitude' => 41.9126444,
                'longitude' => 12.4646885,
                'image' => 'flat_images/appartamento-spazioso-con-cucina-moderna.jpg',
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
