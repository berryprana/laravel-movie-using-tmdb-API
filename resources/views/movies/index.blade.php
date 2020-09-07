@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-16 pt-16">
        <div class="popular-movies mt-10">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularMovies as $movie)
               <x-movie-card :movie="$movie"/> <!-- dari MovieCard.php -->
                @endforeach
            </div>
            <div class="flex justify-between ml-10 mr-10 text-3xl">
                @if ($previous)
                    <a href="/movie/page/{{ $previous }}">&#8666;</a>
                @else
                    <div></div>
                @endif
                @if ($next)
                    <a href="/movie/page/{{ $next }}">&#8658;</a>
                @else
                    <div></div>
                @endif
    
            </div>
        </div>
        <!--End Poppular Movie-->

        <!-- Start Now Plaing -->
        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($nowplayingMovies as $movie)
                <x-movie-card :movie="$movie"/> <!-- dari MovieCard.php -->
                @endforeach
                
            </div>
        </div>
    </div>
            
@endsection