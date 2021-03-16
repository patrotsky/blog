<div class="form-group">
    {!! Form::label('name','Nombre:') !!}
    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre de la publicación']) !!}
    @error('name')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('slug','Slug:') !!}
    {!! Form::text('slug',null,['class'=>'form-control','placeholder'=>'Ingrese el slug de la publicación','readonly']) !!}
    @error('slug')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('category_id','Categoría') !!}
    {!! Form::select('category_id',$categories,null,['class'=>'form-control']) !!}
    @error('category_id')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>
    @foreach($tags as $tag)
        <label class="mr-2">
            {!! Form::checkbox('tags[]',$tag->id,null) !!}
            {{$tag->name}}
        </label>
    @endforeach

    @error('tags')
    <br>
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Estado</p>

    <label>
        {!! Form::radio('status',1,true) !!}{{--todo: status--}}
        Borrador
    </label>

    <label>
        {!! Form::radio('status',2) !!}{{--todo: status--}}
        Publicado
    </label>

    @error('status')
    <br>
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

{{--Imagen--}}
<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset($post->image)
                <img id="picture" src="{{Storage::url($post->image->url)}}" alt="Imagen del blog">
            @else
                <img id="picture"
                     src="https://images.pexels.com/photos/1591056/pexels-photo-1591056.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                     alt="Imagen por defecto, desde Internet."
                >
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="from-group">
            {!! Form::label('file','Imagen de la publicación') !!}
            {{-- Acepte imágenes con cualquier tipo de extensión 'accept'=>'image/*' con Laravel collective--}}
            {!! Form::file('file',['form-control-file','accept'=>'image/*']) !!}
            @error('file')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <p>Instrucciones acerca de las características de esta imagen:<br> <strong>[PENDIENTE]</strong></p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('extract','Extracto:') !!}
    {!! Form::textarea('extract',null,['class'=>'form-control']) !!}
    @error('extract')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('body','Cuerpo de la publicación:') !!}
    {!! Form::textarea('body',null,['class'=>'form-control']) !!}
    @error('body')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
