<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\blog\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct(){
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create','store');
        $this->middleware('can:admin.posts.edit')->only('edit','update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id'); //dd($categories);
        $tags = Tag::all();

        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //dd($request->file('file'));
        //Storage::put('posts',$request->file('file'));
        $post=Post::create($request->all());
        //Dado que no es obligatorio enviar una imagen
        if($request->file('file')){
            //tomar nota de la ubicación y nombre de la imagen, para guardar dicha info en la BD relacional
            $url=Storage::put('posts',$request->file('file'));

            $post->image()->create([
                'url'=>$url
            ]);
        }
        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit',$post)->with('info','La publicación ha sido creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('author',$post);//PostPolicy.php, el cual se da de alta en AuthServiceProvider.php

        $categories = Category::pluck('name','id'); //dd($categories);
        $tags = Tag::all();

        return view('admin.posts.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostRequest  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('author',$post);//PostPolicy.php, el cual se da de alta en AuthServiceProvider.php

        $post->update($request->all());

        //Verificar si el usuario colocó una imagen
        if($request->file('file')){
            $url=Storage::put('posts',$request->file('file'));
            //Si el post ya contaba con una imagen, eliminarla
            if($post->image){
                Storage::delete($post->image->url);
                //Ahora actualizar la URL de la nueva imagen
                $post->image->update([
                    'url'=>$url,
                ]);
            }else{
                //Si no existía, crear un nuevo registro en la tabla de imágenes y relacionarlo al post
                $post->image()->create([
                    'url'=> $url
                ]);
            }
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit',$post)->with('info','La publicación ha sido actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('author',$post);//PostPolicy.php, el cual se da de alta en AuthServiceProvider.php

        $post->delete();
        //Eliminar la imagen asociada a la publicación:
        // un observer es una clase que nos permite agrupar eventos relacionados con un determinado modelo.
        // Dichos eventos se ejecutan cada vez que realicemos alguna acción en dicho modelo. Como puede ser:
        // crear, editar, eliminar un nuevo registro,

        return redirect()->route('admin.posts.index')->with('info','La publicación ha sido eliminada exitosamente.');
    }
}
