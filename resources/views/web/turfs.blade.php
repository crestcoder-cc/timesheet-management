@extends('web.layouts.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div class="container mx-auto">
        <section id="top-turfs" class="py-5">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold mb-5">All Turfs</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($turfs as $turf)
                        <div class="text-center">
                            <a href="{{ route('company-details', [$turf->id]) }}">
                                @if(isset($turf->images[0]->image))
                                    <img src="{{ asset($turf->images[0]->image) }}" alt="Turf 1" class="w-full rounded">
                                @else
                                    <img src="{{ asset('web/assets/img/turf1.jpeg') }}" alt="Turf 1"
                                         class="w-full rounded">
                                @endif
                            </a>
                            <div class="mt-4">
                                <h3 class="text-xl font-semibold">{{ $turf->name }}</h3>
                                <p class="text-lg">Location: {{ $turf->address }}</p>
                                @if(isset($turf->distance))
                                    <p>From your location : {{round($turf->distance)}} km</p>
                                @endif
                                <p class="text-lg font-semibold">Price: $100 | Ratings: <span class="stars">★★★★☆</span>
                                </p>
                                <a href="{{ route('company-details', [$turf->id]) }}" class="btn btn-primary">View
                                    Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
@endsection
