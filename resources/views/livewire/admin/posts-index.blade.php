<div class="card">
    <div class="card-header">
        <input wire:model="search" type="text" class="form-control" placeholder="Ingrese el nombre de una publicación">
    </div>
    @if($posts->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->name}}</td>
                        <td width="10px"><a class="btn btn-primary btn-sm" href="{{route('admin.posts.edit',$post)}}">Editar</a></td>
                        <td width="10px">
                            <form action="{{route('admin.posts.destroy',$post)}}">
                                @method('DELETE')
                                @csrf

                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{$posts->links()}}
        </div>
    @else
        {{--https://adminlte.io/themes/dev/AdminLTE/pages/UI/general.html--}}
        <div class="card-body">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> No hay resultados</h5>
                Intente teclear otra palabra
            </div>
        </div>
    @endif
</div>
