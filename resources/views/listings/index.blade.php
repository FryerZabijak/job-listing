<x-layout>
@include('partials._hero')
@include("partials._search")
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($listings) == 0)
            @foreach ($listings as $listing)
                <x-listing-card :listing="$listing"/>
            @endforeach
        @else
            <p>No listings found :&#40</p>
        @endunless
    </div>

    <style>
        p {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
</x-layout>