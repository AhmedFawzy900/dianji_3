<?php

namespace App\Http\Controllers;

use App\Models\AppSlider;
use App\Models\AppVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppUiController extends Controller
{

    public function slider_index()
    {
        $sliders = AppSlider::all();
        return view('app.slider.index', compact('sliders'));
    }
    public function slider_create(Request $request)
    {
        return view('app.slider.create');
    }
    public function slider_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slider_image' => 'required|image',
            'status' => 'required',
        ]);
    
        $slider = new AppSlider();
        $slider->title = $request->title;
        $slider->status = $request->status;
    
        // Store the image
        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/slider_images', $imageName);
            $slider->image = $imageName;
        }
        $slider->save();
        return redirect()->route('app.slider.index')->with('success', 'تم الحفظ بنجاح');
    }

    public function slider_edit($id)
    {
        $slider = AppSlider::find($id);
        return view('app.slider.edit', compact('slider'));
    }

    public function slider_update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'slider_image' => 'image',
            'status' => 'required',
        ]);
        $slider = AppSlider::find($id);
        $slider->title = $request->title;
        $slider->status = $request->status;

        // Store the image
        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/slider_images', $imageName);

            // Remove the old image
            if ($slider->image) {
                Storage::delete('public/slider_images/'.$slider->image);
            }

            $slider->image = $imageName;
        }
        $slider->save();
        return redirect()->route('app.slider.index')->with('success', 'تم الحفظ بنجاح');
    }

    public function slider_destroy($id)
    {
        $slider = AppSlider::find($id);
        if ($slider->image) {
            Storage::delete('public/slider_images/'.$slider->image);
        }
        $slider->delete();
        return redirect()->route('app.slider.index')->with('success', 'تم الحذف بنجاح');
    }

    // now we will create the same with videos section
    public function videos_index(){
        $videos = AppVideos::all();
        return view('app.video.index', compact('videos'));
    }

    public function videos_create(){
        return view('app.video.create');
    }

    public function videos_store(Request $request){
        $request->validate([
            'title' => 'required',
            'video_link' => 'required',
            'status' => 'required',
            'related_page' => 'sometimes',
        ]);

        $video = new AppVideos();
        $video->title = $request->title;
        $video->video = $request->video_link;
        $video->status = $request->status;
        $video->related_page = $request->related_page;
        $video->save();
        return redirect()->route('app.video.index')->with('success', 'تم الحفظ بنجاح');
    }

    public function videos_edit($id){
        $video = AppVideos::find($id);
        return view('app.video.edit', compact('video'));
    }

    public function videos_update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'video_link' => 'required',
            'status' => 'required',
            'related_page' => 'sometimes',
        ]);

        $video = AppVideos::find($id);
        $video->title = $request->title;
        $video->video = $request->video_link;
        $video->status = $request->status;
        $video->related_page = $request->related_page;
        $video->save();
        return redirect()->route('app.videos.index')->with('success', 'تم الحفظ بنجاح');
    }

    public function videos_destroy($id){
        $video = AppVideos::find($id);
        $video->delete();
        return redirect()->route('app.videos.index')->with('success', 'تم الحذف بنجاح');
    }
       
}
