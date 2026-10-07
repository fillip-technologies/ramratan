@extends('admin.include.layout')

@section('heading', 'Banners / Videos')
@section('title', 'Add Banners / Videos')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow rounded p-6 mt-6">
        <h2 class="text-2xl font-bold mb-6">Add New Banners / Videos</h2>

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

        <form action="{{ route('banner.video.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Slider Multiple Images -->
    <div>
        <label class="font-semibold text-lg">Slider Images (Multiple)</label>
        <input type="file" name="slider_images[]" multiple accept="image/*"
               class="block w-full border p-3 rounded mt-2">
    </div>

    <!-- Multiple Videos Section -->
    <div>
        <label class="font-semibold text-lg">Upload Multiple Videos</label>
        <input type="file" name="multi_videos[]" multiple accept="video/mp4,video/mpeg,video/*"
               class="block w-full border p-3 rounded mt-2">
    </div>

    <!-- Single Video Upload -->
    <div>
        <label class="font-semibold text-lg">Upload Single Video</label>
        <input type="file" name="single_video" accept="video/mp4,video/mpeg,video/*"
               class="block w-full border p-3 rounded mt-2">
    </div>

    <!-- Video Gallery (Multiple) -->
    <div>
        <label class="font-semibold text-lg">Video Gallery (Multiple)</label>
        <input type="file" name="gallery_videos" class="block w-full border p-3 rounded mt-2">
    </div>

    <button type="submit"
            class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
        Upload Media
    </button>
</form>

    </div>
@endsection
