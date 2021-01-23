<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Slider;
use File;
use Image;

class SlidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $sliders = Slider::orderBy('priority', 'asc')->get();
        return view('backend.pages.sliders.index', compact('sliders'));
    }

    public function store(Request $request){
        
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'priority' => 'required',
            'button_link' => 'nullable|url',
        ],

        [
            'title.required' => 'Please provide slider title',
            'priority.required' => 'Please provide slider priority',
            'image.required' => 'Please provide slider image',
            'image.image' => 'Please provide a valid slider image',
            'button_link.url' => 'Please provide a valid slider button link',
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->priority;

        if ($request->image > 0){
            $image = $request->file('image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/sliders/'.$img);
            Image::make($image)->save($location);
            $slider->image = $img;            
        }
        
        $slider->save();
        session()->flash('success', 'A new Slider has added successfully !!');
        return redirect()->route('admin.sliders');
    }

    public function update(Request $request, $id){
        
        $request->validate([
            'name' => 'required',
            'priority' => 'required',
        ],

        [
            'name.required' => 'Please provide a division name',
            'priority.required'=> 'Please provide a division priority',
        ]);

        $division = Division::find($id);

        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();

        session()->flash('success', 'A division has updated successfully !!');
        return redirect()->route('admin.divisions');
    }

    public function delete($id){

        $division = Division::find($id);

        if(!is_null($division)){
            //Delete all the districs for this division
            $districts = District::where('division_id', $division->id)->get();
            foreach ($districts as $district) {
                $district->delete();
            }
            $division->delete();
        }

        session()->flash('success', 'A division has deleted successfully !!');
        return redirect()->back();
    }

}
