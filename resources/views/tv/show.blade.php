@extends('layouts.main')

@section('content')
    <div class="tv-info">
        <div class="container mx-auto px-16 py-16 flex flex-col md:flex-row">
            <img src="{{ $tv['poster_path'] }}" alt="" class="w-64 md:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold mt-1">{{ $tv['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2">
                    <path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                    <span class="ml-1">{{ $tv['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tv['first_air_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{ $tv['genres'] }}
                    </span>
                    <span class="mx-2">|</span>
                    {{ $tv['origin_country'] }}
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $tv['overview'] }}
                </p> 
                
                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Crew</h4>
                    <div class="flex mt-4">
                        @foreach ($tv['crew'] as $crew)
                                <div class="mr-8">
                                    <div>{{ $crew['name']}}</div>
                                    <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                                </div>                                    
                        @endforeach
                    </div>
                </div>
                <!--Trailer Play Button-->
                <div x-data="{ isOpen:false }">
                    @if (count($tv['videos']['results']) >0 )
                    <div class="mt-12">
                        <button
                            @click="isOpen = true"
                            @click.away="isOpen = false"
                            @keydown.escape.window="isOpen= false"
                            href="https://youtube.com/watch?v={{ $tv['videos']['results'][0]['key'] }}" 
                            class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150" 
                            target="_blank" rel="noopener noreferrer">
                            <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                            <span class="ml-2">Trailer</span>
                        </button>
                    </div>
                    @endif
                    <!--End Trailer Play Button-->
    
                    <!--Start Youtube Modal-->
                    <div style="background-color: rgba(0, 0, 0, 0.5);"
                            class="fixed top-0 right-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            x-show.transition.opacity="isOpen"
                            >
                                <div class="pt-10 container w-10/12 h-10/12 mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button @click="isOpen = false" class="text-3xl leading-none 
                                            hover:text-gray-300">&times;</button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative" 
                                                style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" 
                                                src="https://www.youtube.com/embed/{{ $tv['videos']['results'][0]['key'] }}" 
                                                style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Youtube Modal-->

                <!-- Start Season-->
                <div class="tv-season">
                    @foreach ($tv['seasons'] as $season)
                    <div class="container mx-auto px-16 py-2 pb-10 flex flex-col md:flex-row">
                        <img src="{{'https://image.tmdb.org/t/p/w130_and_h195_bestv2/'.$season['poster_path']}}" alt="" class="md:w-96">
                        <div class="md:ml-10">
                            <h2 class="text-lg font-semibold mt-1">{{ $season['name'] }}</h2>
                            <div class="flex flex-wrap items-center text-gray-400 text-sm">
                                <span class="ml-1">{{ date('M d, Y', strtotime($season['air_date'])) }}</span>
                                <span class="mx-2">|</span>
                                <span>{{$season['episode_count']}} Episode</span>
                                <span class="mx-2">|</span>
                            </div>
                            <p class="text-gray-300 mt-5">
                                {{ $season['name'] }} of {{ $tv['name'] }} premiered on {{ date('M d, Y', strtotime($season['air_date'])) }}
                            </p> 
                        </div>
                    </div>
                    @endforeach
                </div>
            <!-- Start Season-->
            
        
                


            <!-- Start movie-cast -->
            <div class="movie-cast  border-t border-gray-800">
                <div class="container mx-auto px-16 py-16">
                    <h2 class="text-4xl font-semibold">Cast</h2>
                    <div class="grid grid-cols-5 gap-8 ">
                        @foreach ($tv['cast'] as $cast)
                        <div class="mt-8">
                            <a href="{{ route('actors.show', $cast['id']) }}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path']}}" alt="" 
                                class="hover:opacity-50 transition ease-in-out duration-150">
                            </a>
                            <div class="mt-2">
                            <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray:300 "> {{ $cast['name'] }} </a>
                                <div class="text-sm text-gray-400">
                                    {{ $cast['character'] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div> <!-- end movie-cast -->   

                            <!--start movie image-->
                            <div class="movie-image" x-data="{ isOpen: false, images: ''}">
                                <div class="container mx-auto px-16 py-16">
                                    <h2 class="text-4xl font-semibold">Images</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                                        @foreach ($tv['images'] as $images)
                                        <div class="mt-8">
                                            <a
                                            @click.prevent="
                                            isOpen = true
                                            image='{{ 'https://image.tmdb.org/t/p/original/'.$images['file_path'] }}'
                                            "
                                            href="#">
                                                <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$images['file_path'] }}" alt="" class="hover:opacity-50 transition ease-in-out duration-150">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
            
                                    <!--Start Image Modal-->
                                    <div style="background-color: rgba(0, 0, 0, 0.5);"
                                    class="fixed top-0 right-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                                    x-show.transition.opacity="isOpen"
                                    >
                                        <div class="pt-10 container w-10/12 h-10/12 mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                            <div class="bg-gray-900 rounded">
                                                <div class="flex justify-end pr-4 pt-2">
                                                    <button 
                                                    @click="isOpen = false"
                                                    @click.away="isOpen = false"
                                                    @keydown.escape.window="isOpen= false"
                                                    class="text-3xl leading-none 
                                                    hover:text-gray-300">&times;</button>
                                                </div>
                                                <div class="modal-body px-8 py-8">
                                                    <img :src="image" alt="poster">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Image Modal-->
            </div>
        </div>
    </div>

@endsection