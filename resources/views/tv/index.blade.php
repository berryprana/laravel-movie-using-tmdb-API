@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-16 pt-16">
        <div class="popular-tv mt-10">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular TV</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularTvs as $tv)
                <x-tv-card :tv="$tv"/> <!-- dari tvcard.php -->
                 @endforeach
            </div>
            <div class="flex justify-between ml-10 mr-10 text-3xl">
               
    
            </div>
        </div>
        <!--End Poppular tv-->
    </div>
            
@endsection