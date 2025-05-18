@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-3 items-center w-full">
        @if ($photos->isEmpty())
            <div class="col-span-3 text-center h-screen items-center flex justify-center">
                <h1 class="text-2xl font-bold">No photos available</h1>
            </div>
        @else
            @foreach ($photos as $photo)
                <div class="col-span-1 p-1 md:p-2 lg:p-4">
                    <a href="{{ asset('storage/' . $photo->image) }}" class="glightbox" data-gallery="gallery1"
                        data-title="{{ $photo->title }}" data-description="{{ $photo->description }}">
                        <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}"
                            class="w-full object-contain max-h-80">
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
