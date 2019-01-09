<?php

namespace App\Http\Controllers;
use App\Widget;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WidgetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets = Widget::paginate(10);
        return view('widget.index',compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('widget.create');
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
            'name' => 'required|unique:widgets|string|max:30',
        ]);

        $slug = str_slug($request->name,"-");
        $widget = Widget::create(['name'=>$request->name,'slug'=>$slug,'user_id'=>Auth::id()]);
        $widget->save();
        session()->flash('Widget','Create Successfully');
        return Redirect::route('widget.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$slug='')
    {
        $widget = Widget::findOrFail($id);
        if ($widget->slug !== $slug) {
            return Redirect::route('widget.show', ['id' => $widget->id,
                'slug' => $widget->slug],
                301);
        }
        return view('widget.show', compact('widget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $widget = Widget::findOrFail($id);
        return view('widget.edit',compact('widget'));
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
        $this->validate($request,['name'=> 'required|string|max:30|unique:widgets,name,'.$id]);
        $widget = Widget::findOrFail($id);
        $slug = str_slug($request->name,"-");
        $widget->update([
            'name' => $request->name,
            'slug' => $slug,
            'user_id' => Auth::id()
        ]);
        return Redirect::route('widget.show',['widget'=>$widget,'slug'=>$slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Widget::destroy($id);
        return Redirect::route('widget.index');
    }
}
