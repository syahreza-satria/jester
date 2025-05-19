@extends('layouts.app')

@section('content')
    <div class="grid items-center w-full grid-cols-3">
        @if ($photos->isEmpty())
            <div class="flex items-center justify-center h-screen col-span-3 text-center">
                <h1 class="text-2xl font-bold">No photos available</h1>
            </div>
        @else
            @foreach ($photos as $photo)
                <div class="col-span-1 p-1 md:p-2 lg:p-4">
                    <a href="{{ asset('storage/app/public/' . $photo->image) }}" class="glightbox" data-gallery="gallery1"
                        data-title="{{ $photo->title }}" data-description="{{ $photo->description }}">
                        <img src="{{ asset('storage/app/public/' . $photo->image) }}" alt="{{ $photo->title }}"
                            class="object-contain w-full max-h-96">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true
            });
        });
    </script>
@endsection
