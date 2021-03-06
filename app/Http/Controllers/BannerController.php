<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\DB;





class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
       
    public function index()
    {
        $role=Auth::user()->role;
        if($role=='admin'){
            $banners=Banner::orderBy('id','DESC')->get();
            return view('backend.banners.index',compact('banners'));
        }
        else{
            return view('error');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'string|required',
            'description' => 'string|nullable',
            'photo' =>  'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|in:active,inactive',
        ]);
        


        


        $data=$request->all();

        
        $name = $request->file('photo')->getClientOriginalName();
        $photo=$request->photo->move(public_path('photos'), $name);
        $data['photo']=$name;
        
        $slug=Str::slug($request->input('title'));
        $slug_count=Banner::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().'-'.$slug;
        }
        $data['slug']=$slug;
        
        $status=Banner::create($data);
        if($status)
        {
            return redirect()->route('banner.index')->with('success','successfully created banner');
        }
        else{
            return back()->with('error','something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner=Banner::find($id);
        if($banner)
        {
            return view('backend.banners.edit',compact('banner'));
        }
        else{
            return back()->with('error','Data not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner=Banner::find($id);
        if($banner)
        {
            $this->validate($request,[
                'title' => 'string|required',
                'description' => 'string|nullable',
                'photo' =>  'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'nullable|in:active,inactive',
            ]);
            $data=$request->all();

            $name = $request->file('photo')->getClientOriginalName();
            $photo=$request->photo->move(public_path('photos'), $name);
            $data['photo']=$name;
            
            $status=$banner->fill($data)->save();
            if($status)
            {
                return redirect()->route('banner.index')->with('success','successfully Updated banner');
            }
            else{
                return back()->with('error','something went wrong');
            }
        }
        else{
            return back()->with('error','Data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $data=Banner::find($id);
        $data->delete();
        return redirect()->route('banner.index')->with('success delete','successfully deleted banner');
    }

    
}



