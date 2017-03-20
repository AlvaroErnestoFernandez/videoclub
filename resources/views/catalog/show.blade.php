@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-sm-4">
			{{-- TODO: Imagen de la película --}}
			<img src="{{$pelicula->poster}}" style="height:100%;width:85%"/>
		</div>
		<div class="col-sm-8">
			{{-- TODO: Datos de la película --}}
			<div class="row">
				<h1>{{$pelicula->title}}</h1>
				<h3>Año: {{$pelicula->year}}</h3>
				<h3>Director: {{$pelicula->director}}</h3><p>
				<p style="line-height: 24px"><strong>Resumen:</strong>{{$pelicula->synopsis}}</p>
				<p><strong>Estado:</strong>
				@if ($pelicula->rented)
					Pelicula actualmente alquilada
				@else
					Pelicula disponible
				@endif
				</p>
			</div>
			</p>
			<div class="row">
				<div class="col-sm-3">
					@if ($pelicula->rented)
						<form action="{{action('CatalogController@putReturn', $pelicula->id)}}"
						method="POST" style="display:inline">
						{{ method_field('PUT') }}
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary btn-lg btn-block">
						Devolver película
						</button>
						</form>
					@else
						<form action="{{action('CatalogController@putRent', $pelicula->id)}}"
						method="POST" style="display:inline">
						{{ method_field('PUT') }}
						{{ csrf_field() }}
						<button type="submit" class="btn btn-success btn-lg btn-block">
						Alquilar película
						</button>
						</form>
					@endif					
				</div>
				<div class="col-sm-3">
					<a href="{{url('catalog/edit/'.$pelicula->id)}}" type="button" class="btn btn-warning btn-lg btn-block">Editar pelicula</a>
				</div>
				<div class="col-sm-3">
					<form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}"
						method="POST" style="display:inline">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="submit" class="btn btn-danger btn-lg btn-block">
						Eliminar
						</button>
					</form>
				</div>
					<div class="col-sm-3">
					<a href="{{url('catalog')}}" type="button" class="btn btn-default btn-lg btn-block">Volver al listado</a>
				</div>
			</div>
		</div>
	</div>
@stop