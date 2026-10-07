<?php

namespace App\Http\Controllers;

use App\Models\ManageBv;
use Illuminate\Http\Request;

class ManegeBVController extends Controller
{
   public function index()
{
    return view('admin.manegebannervideo.index');
}


public function store(Request $request)
{
    $request->validate([
        'slider_images.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp',
        'multi_videos.*'    => 'nullable|mimes:mp4,mov,avi,flv,wmv',
        'single_video'      => 'nullable|mimes:mp4,mov,avi,flv,wmv',
        'gallery_videos'    => 'nullable|mimes:mp4,mov,avi,flv,wmv',
    ]);

    $banner = [
        'slider_image' => [],
        'mines_video'  => [],
    ];


    if ($request->hasFile('slider_images')) {
        foreach ($request->file('slider_images') as $img) {
            $filename = uniqid() . '_' . time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/banner/images'), $filename);

            $banner['slider_image'][] = $filename;
        }
    }

    if ($request->hasFile('multi_videos')) {
        foreach ($request->file('multi_videos') as $video) {
            $filename = uniqid() . '_' . time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/banner/videos'), $filename);

            $banner['mines_video'][] = $filename;
        }
    }

    if ($request->hasFile('single_video')) {

        $single = $request->file('single_video');
        $filename = uniqid() . '_' . time() . '.' . $single->getClientOriginalExtension();

        $single->move(public_path('uploads/banner/singleVideo'), $filename);

        $banner['during_video'] = $filename;
    }

    if ($request->hasFile('gallery_videos')) {
        $gallery = $request->file('gallery_videos');
        $filename = uniqid() . '_' . time() . '.' . $gallery->getClientOriginalExtension();

        $gallery->move(public_path('uploads/banner/galleryVideo'), $filename);

        $banner['gallery_video'] = $filename;
    }
    $banner['slider_image'] = !empty($banner['slider_image'])
        ? json_encode($banner['slider_image'])
        : null;
    $banner['mines_video'] = !empty($banner['mines_video'])
        ? json_encode($banner['mines_video'])
        : null;
    ManageBv::create($banner);

    return back()->with('success', 'Banner images & videos uploaded successfully!');
}



public function edit($id)
{
    $item = ManageBv::findOrFail($id);
    return view('admin.manegebannervideo.edit', compact('item'));
}

public function list()
{
    $items = ManageBv::latest()->get();
    return view('admin.manegebannervideo.list', compact('items'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'slider_images.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp',
        'multi_videos.*'    => 'nullable|mimes:mp4,mov,avi,flv,wmv',
        'single_video'      => 'nullable|mimes:mp4,mov,avi,flv,wmv',
        'gallery_videos'    => 'nullable|mimes:mp4,mov,avi,flv,wmv',
    ]);
    $banner = ManageBv::findOrFail($id);
    $slider_images = $banner->slider_image ? json_decode($banner->slider_image, true) : [];
    $multi_videos  = $banner->mines_video ? json_decode($banner->mines_video, true) : [];


    if ($request->hasFile('slider_images')) {
        foreach ($request->file('slider_images') as $img) {
            $filename = uniqid() . '_' . time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/banner/images'), $filename);
            $slider_images[] = $filename;
        }
    }


    if ($request->hasFile('multi_videos')) {
        foreach ($request->file('multi_videos') as $video) {
            $filename = uniqid() . '_' . time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/banner/videos'), $filename);
            $multi_videos[] = $filename;
        }
    }

    if ($request->hasFile('single_video')) {

        if ($banner->during_video && file_exists(public_path('uploads/banner/singleVideo/' . $banner->during_video))) {
            unlink(public_path('uploads/banner/singleVideo/' . $banner->during_video));
        }

        $single = $request->file('single_video');
        $filename = uniqid() . '_' . time() . '.' . $single->getClientOriginalExtension();
        $single->move(public_path('uploads/banner/singleVideo'), $filename);
        $banner->during_video = $filename;
    }


    if ($request->hasFile('gallery_videos')) {

        if ($banner->gallery_video && file_exists(public_path('uploads/banner/galleryVideo/' . $banner->gallery_video))) {
            unlink(public_path('uploads/banner/galleryVideo/' . $banner->gallery_video));
        }

        $gallery = $request->file('gallery_videos');
        $filename = uniqid() . '_' . time() . '.' . $gallery->getClientOriginalExtension();
        $gallery->move(public_path('uploads/banner/galleryVideo'), $filename);
        $banner->gallery_video = $filename;
    }


    $banner->slider_image = !empty($slider_images) ? json_encode($slider_images) : null;
    $banner->mines_video  = !empty($multi_videos) ? json_encode($multi_videos) : null;
    $banner->save();

    return back()->with('success', 'Banner updated successfully!');
}


public function delete($id)
{
    ManageBv::where('id', $id)->delete();
    return back()->with('success', 'Banner deleted successfully!');
}


public function removeImage($id, $key)
{
    $banner = ManageBv::findOrFail($id);
    $images = json_decode($banner->slider_image, true);

    if (isset($images[$key]) && file_exists(public_path('uploads/banner/images/'.$images[$key]))) {
        unlink(public_path('uploads/banner/images/'.$images[$key]));
        unset($images[$key]);
    }

    $banner->slider_image = !empty($images) ? json_encode(array_values($images)) : null;
    $banner->save();

    return back()->with('success', 'Slider image removed successfully.');
}

public function removeMultiVideo($id, $key)
{
    $banner = ManageBv::findOrFail($id);
    $videos = json_decode($banner->mines_video, true);

    if (isset($videos[$key]) && file_exists(public_path('uploads/banner/videos/'.$videos[$key]))) {
        unlink(public_path('uploads/banner/videos/'.$videos[$key]));
        unset($videos[$key]);
    }

    $banner->mines_video = !empty($videos) ? json_encode(array_values($videos)) : null;
    $banner->save();

    return back()->with('success', 'Video removed successfully.');
}


public function removeSingleVideo($id)
{
    $banner = ManageBv::findOrFail($id);

    if ($banner->during_video && file_exists(public_path('uploads/banner/singleVideo/'.$banner->during_video))) {
        unlink(public_path('uploads/banner/singleVideo/'.$banner->during_video));
        $banner->during_video = null;
        $banner->save();
    }

    return back()->with('success', 'Single video removed successfully.');
}


public function removeGalleryVideo($id)
{
    $banner = ManageBv::findOrFail($id);

    if ($banner->gallery_video && file_exists(public_path('uploads/banner/galleryVideo/'.$banner->gallery_video))) {
        unlink(public_path('uploads/banner/galleryVideo/'.$banner->gallery_video));
        $banner->gallery_video = null;
        $banner->save();
    }

    return back()->with('success', 'Gallery video removed successfully.');
}


}
