<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * TagController constructor.
     */
    public function __construct(){
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.create')->only('create','store');
        $this->middleware('can:admin.tags.edit')->only('edit','update');
        $this->middleware('can:admin.tags.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors= [
            'yellow'=>'Amarillo',
            'blue'=>'Azul',
            'indigo'=>'Indigo',
            'purple'=>'Morado',
            'red'=>'Rojo',
            'pink'=>'Rosa',
            'green'=>'Verde',
        ];
        return view('admin.tags.create',compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'slug'=>'required|unique:tags|max:255',
            'color'=>'required|max:255'
        ]);

        $tag = Tag::create($request->all());

        return redirect()->route('admin.tags.edit',$tag)->with('info','La etiqueta ha sido creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show',compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $colors= [
            'yellow'=>'Amarillo',
            'blue'=>'Azul',
            'indigo'=>'Indigo',
            'purple'=>'Morado',
            'red'=>'Rojo',
            'pink'=>'Rosa',
            'green'=>'Verde',
        ];
        return view('admin.tags.edit',compact('tag','colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name'=>'required|max:255',
            'slug'=>"required|unique:tags,slug,$tag->id|max:255",
            'color'=>'required|max:255'
        ]);

        $tag->update($request->all());

        return redirect()->route('admin.tags.edit',$tag)->with('info','La etiqueta ha sido actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('info','La etiqueta ha sido eliminada con éxito');
    }
}
