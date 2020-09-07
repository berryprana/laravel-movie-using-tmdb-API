<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{   
    public $popularMovies;
    public $nowplayingMovies;
    public $genres;
    public $page;
    

    public function __construct($popularMovies, $nowplayingMovies, $genres, $page)
    {
        $this->popularMovies = $popularMovies;
        $this->nowplayingMovies = $nowplayingMovies;
        $this->genres = $genres;
        $this->page = $page;
        
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }


    public function nowplayingMovies()
    {
       return $this->formatMovies($this->nowplayingMovies);
    }


    public function genres()
    {   
        //Mengambill array dari field genre (id,nama_genre | contoh = 0 as id => Action as nama_genre, 1 => Drama)
       return collect($this->genres)->mapwithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($movies)
    {

        return collect($movies)->map(function($movie){

            //format genre untuk mendapatkan genre berdasarkan genre_ids = dikarenakan genre mempunyai array (array dalam array)
            $genresFormatted = collect($movie['genre_ids'])->mapwithKeys(function ($value)
            {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

                return collect($movie)->merge([
                    'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                    'vote_average' => $movie['vote_average'],
                    'release_date' => \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y'),
                    'original_language' => strtoupper($movie['original_language']),
                    'genres' => $genresFormatted,
                ])->only(['id', 'poster_path', 'vote_average', 'release_date', 
                        'original_language', 'title', 'genre_ids', 'genres']); //only() untuk mengambil field yang diinginkan saja / tidak semua isi table di ambil
        });
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 1000 ? $this->page + 1 : null;
    }

   
}
