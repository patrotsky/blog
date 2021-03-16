<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(){
        if(request()->page){
            $key = 'posts' . request()->page;
        }else{
            $key = 'posts';
        }

        if(Cache::has($key)){
            $posts = Cache::get($key);
        }else{//El contenido del else se puede comentar para comprobar que el caché está realmente funcionando
            $posts = Post::where('status',2)->latest('id')->paginate(8);//todo: 1=draft, 2=published
            Cache::put($key,$posts,now()->addMinutes(10));
        }

        return view('posts.index',compact('posts'));
    }

    public function show(Post $post){
        $this->authorize('published',$post);//Antes de mostrar, verificar si ya ha sido publicada

        $similares = Post::where('category_id',$post->category_id)
            ->where('status',2)
            ->where('id','<>',$post->id)//Para que no muestre el mismo post en la lista de relacionados!
            ->latest('id')
            ->take(4)
            ->get();
        return view('posts.show',compact('post','similares'));
    }

    public function category(Category $category){
        $posts=Post::where('category_id',$category->id)
            ->where('status',2)//todo: published
            ->latest('id')
            ->paginate(6);

        return view('posts.category',compact('posts','category'));
    }

    public function tag(Tag $tag){
        //6:15 Inconveniente: el listado de posts que nos está devolviendo los posts con estado 1 (draft),
        //6:40 hay que agregarle el filtro de estado = 2 (published). Entonces mejor le agregamos la relación (en vez de ->posts, ->posts() ).
        $posts = $tag->posts()->where('status',2)->latest('id')->paginate(4);//todo: 2 = published
        return view('posts.tag',compact('posts','tag'));
    }
}
