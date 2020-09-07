<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTvs;
    public $genres;
    

    public function __construct($popularTvs, $genres)
    {
        $this->popularTvs = $popularTvs;
        $this->genres = $genres;

        
    }


    public function genres()
    {   
        //Mengambill array dari field genre (id,nama_genre | contoh = 0 as id => Action as nama_genre, 1 => Drama)
       return collect($this->genres)->mapwithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    public function popularTvs()
    {
        return $this->formatTvs($this->popularTvs);
    }


    private function formatTvs($tvs)
    {

        return collect($tvs)->map(function($tv){

            //format genre untuk mendapatkan genre berdasarkan genre_ids = dikarenakan genre mempunyai array (array dalam array)
            $genresFormatted = collect($tv['genre_ids'])->mapwithKeys(function ($value)
            {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

                return collect($tv)->merge([
                    'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$tv['poster_path'],
                    'vote_average' => $tv['vote_average'],
                    'first_air_date' => \Carbon\Carbon::parse($tv['first_air_date'])->format('M d, Y'),
                    'original_language' => strtoupper($tv['original_language']),
                    'genres' => $genresFormatted,
                ])->only('id','poster_path','vote_average','first_air_date','original_language','genres','name'); //only() untuk mengambil field yang diinginkan saja / tidak semua isi table di ambil
        });
    }

}
