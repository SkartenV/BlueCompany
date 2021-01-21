<h1> {{ $modo }} empleado </h1>

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">

<label for="Nombre"> Nombre </label>
<input type="text" name="Nombre" class="form-control" value="{{ isset($persona->nombre)?$persona->nombre:old('Nombre') }}" >
</div>

<div class="form-group">
<label for="Apellido"> Apellido </label>
<input type="text" name="Apellido" class="form-control" value="{{ isset($persona->apellido)?$persona->apellido:old('Apellido') }}" >
</div>

<div class="form-group">
<label for="Cargo"> Cargo </label>
<input type="text" name="Cargo" class="form-control" value="{{ isset($persona->cargo)?$persona->cargo:old('Cargo') }}" >
</div>

<div class="form-group">
<label for="Peso"> Peso </label>
<input type="text" name="Peso" class="form-control" value="{{ isset($persona->peso)?$persona->peso:old('Peso') }}" >
</div>

<div class="form-group">
<label for="Descripcion"> Descripción </label>
<input type="text" name="Descripcion" class="form-control" value="{{ isset($persona->descripcion)?$persona->descripcion:old('Descripcion') }}" >
</div>

<div class="form-group">
<label for="Link"> Link </label>
<input type="text" name="Link" class="form-control" value="{{ isset($persona->link)?$persona->link:old('Link') }}" >
</div>

<div class="form-group">
<label for="Imagen"> Foto </label>
@if(isset($persona->imagen))
<img src="{{ asset('storage').'/'.$persona->imagen }}" class="img-thumbnail img-fluid" width="100" alt="">
@endif
<input type="file" name="Imagen" class="form-control" value="" >
</div>

<input type="submit" class="btn btn-success" value="{{ $modo }} datos" >

<a href="{{ url('persona/') }}" class="btn btn-primary"> Regresar </a>