@extends('admin.include.layout')

@section('heading', 'Banners / Videos')
@section('title', 'Edit Banners / Videos')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded p-6 mt-6">
    <h2 class="text-2xl font-bold mb-6">Edit Banners / Videos</h2>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('banner.video.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="font-semibold text-lg">Slider Images (Multiple)</label>
            <div class="flex flex-wrap gap-2 mt-2 mb-2">
                @if($item->slider_image)
                    @foreach(json_decode($item->slider_image) as $key => $img)
                        <div class="relative">
                            <img src="{{ asset('uploads/banner/images/'.$img) }}" class="w-24 h-24 object-cover rounded">
                            <a href="{{ route('banner.removeImage', [$item->id, $key]) }}"
                               class="absolute top-0 right-0 bg-red-600 text-white px-1 rounded-full"
                               onclick="return confirm('Remove this image?')">&times;</a>
                        </div>
                    @endforeach
                @endif
            </div>
            <input type="file" name="slider_images[]" multiple accept="image/*"
                   class="block w-full border p-3 rounded">
        </div>

        <!-- Multiple Videos -->
        <div>
            <label class="font-semibold text-lg">Multiple Videos</label>
            <div class="flex flex-wrap gap-2 mt-2 mb-2">
                @if($item->mines_video)
                    @foreach(json_decode($item->mines_video) as $key => $video)
                        <div class="relative">
                            <video width="120" height="80" controls class="rounded">
                                <source src="{{ asset('uploads/banner/videos/'.$video) }}" type="video/mp4">
                            </video>
                            <a href=""
                               class="absolute top-0 right-0 bg-red-600 text-white px-1 rounded-full"
                               onclick="return confirm('Remove this video?')">&times;</a>
                        </div>
                    @endforeach
                @endif
            </div>
            <input type="file" name="multi_videos[]" multiple accept="video/mp4,video/mpeg,video/*"
                   class="block w-full border p-3 rounded">
        </div>

        <!-- Single Video -->
        <div>
            <label class="font-semibold text-lg">Single Video</label>
            @if($item->during_video)
                <div class="mb-2 relative">
                    <video width="200" height="120" controls class="rounded">
                        <source src="{{ asset('uploads/banner/singleVideo/'.$item->during_video) }}" type="video/mp4">
                    </video>
                    <a href="{{ route('banner.removeSingleVideo', $item->id) }}"
                       class="absolute top-0 right-0 bg-red-600 text-white px-1 rounded-full"
                       onclick="return confirm('Remove this video?')">&times;</a>
                </div>
            @endif
            <input type="file" name="single_video" accept="video/mp4,video/mpeg,video/*"
                   class="block w-full border p-3 rounded">
        </div>

        <!-- Gallery Video -->
        <div>
            <label class="font-semibold text-lg">Gallery Video</label>
            @if($item->gallery_video)
                <div class="mb-2 relative">
                    <video width="200" height="120" controls class="rounded">
                        <source src="{{ asset('uploads/banner/galleryVideo/'.$item->gallery_video) }}" type="video/mp4">
                    </video>
                    <a href="{{ route('banner.removeGalleryVideo', $item->id) }}"
                       class="absolute top-0 right-0 bg-red-600 text-white px-1 rounded-full"
                       onclick="return confirm('Remove this video?')">&times;</a>
                </div>
            @endif
            <input type="file" name="gallery_videos" class="block w-full border p-3 rounded">
        </div>

        <button type="submit"
                class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
            Update Media
        </button>
    </form>
</div>
@endsection
