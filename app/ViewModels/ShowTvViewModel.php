<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;


class ShowTvViewModel extends ViewModel
{
    
    public $tv;
    
    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function tv()
    {

        $launchDate = collect($this->tv['seasons'])->pluck('air_date');

        // dump($launchDate);
        return collect($this->tv)->merge([
            'poster_path' => $this->tv['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/'.$this->tv['poster_path']
                : 'https://via.placeholder.com/185x278',
            'vote_average' => $this->tv['vote_average'],
            'first_air_date' => \Carbon\Carbon::parse($this->tv['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tv['genres'])->pluck('name')->flatten()->implode(', '),
            'origin_country' => collect($this->tv['origin_country'])->implode(', '),
            'crew' => collect($this->tv['credits']['crew'])->take(3),
            'cast' => collect($this->tv['credits']['cast'])->take(5),
            'images' => collect($this->tv['images']['backdrops'])->take(9),

            'launchDate' => ($launchDate)
        ]);
    }
}
