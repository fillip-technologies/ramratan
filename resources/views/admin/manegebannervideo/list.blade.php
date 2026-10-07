@extends('admin.include.layout')
@section('heading', 'Banners / Videos')
@section('title', 'Banners / Videos')

@section('content')
<div class="mx-auto bg-white shadow rounded p-6 mt-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Banners / Videos List</h1>
        <a href="{{ route('banner.video') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            + Add Banners / Videos
        </a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 rounded">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border px-4 py-2 w-12">#</th>
                    <th class="border px-4 py-2">Slider Images</th>
                    <th class="border px-4 py-2">Multiple Videos</th>
                    <th class="border px-4 py-2">Single Video</th>
                    <th class="border px-4 py-2">Gallery Video</th>
                    <th class="border px-4 py-2 text-center w-36">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($items as $key => $banner)
                    <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                        
                        {{-- SL NO --}}
                        <td class="border px-4 py-2 font-semibold">{{ $key + 1 }}</td>

                        {{-- Slider Images --}}
                        <td class="border px-4 py-2">
                            @if($banner->slider_image)
                                <div class="flex flex-wrap gap-2">
                                    @foreach(json_decode($banner->slider_image) as $img)
                                        <img src="{{ asset('uploads/banner/images/'.$img) }}"
                                             class="w-16 h-16 object-cover rounded shadow"
                                             alt="">
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>

                        {{-- Multiple Videos --}}
                        <td class="border px-4 py-2">
                            @if($banner->mines_video)
                                <div class="flex gap-2 flex-wrap">
                                    @foreach(json_decode($banner->mines_video) as $video)
                                        <video width="80" height="60" controls class="rounded shadow">
                                            <source src="{{ asset('uploads/banner/videos/'.$video) }}" type="video/mp4">
                                        </video>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>

                        {{-- Single Video --}}
                        <td class="border px-4 py-2">
                            @if($banner->during_video)
                                <video width="120" class="rounded shadow" controls>
                                    <source src="{{ asset('uploads/banner/singleVideo/'.$banner->during_video) }}" type="video/mp4">
                                </video>
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>

                        {{-- Gallery Video --}}
                        <td class="border px-4 py-2">
                            @if($banner->gallery_video)
                                <video width="120" class="rounded shadow" controls>
                                    <source src="{{ asset('uploads/banner/galleryVideo/'.$banner->gallery_video) }}" type="video/mp4">
                                </video>
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="border px-4 py-2 text-center">
                            <div class="flex justify-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('banner.video.edit', $banner->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow text-sm">
                                   Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('banner.delete', $banner->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-sm">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-4 text-center text-gray-500">
                            No banners/videos found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection
