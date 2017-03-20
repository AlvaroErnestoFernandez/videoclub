<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Movie;

use Notification;


class CatalogController extends Controller
{
    //

	public function getIndex()
	{
		$movies = Movie::all();
        return view('catalog.index', ['peliculas' => $movies]);
	}
	public function getShow($id)
	{
		$pelicula = Movie::findOrFail($id);
		return view('catalog.show', ['pelicula' => $pelicula]);
	}
	public function getCreate()
	{
		return view('catalog.create');
	}
	public function getEdit($id)
	{
		$pelicula = Movie::findOrFail($id);
		return view('catalog.edit', ['pelicula' => $pelicula]);
	}	
	public function postCreate(Request $request)
	{
		$p = new Movie;
		$p->title = $request['title'];
		$p->year = $request['year'];
		$p->director = $request['director'];
		$p->poster = $request['poster'];
		$p->synopsis = $request['synopsis'];
		$p->save();
		return redirect('/catalog');
	}	
	public function putEdit(Request $request, $id)
	{
		Movie::where('id', $id)
			->update(['title' => $request['title'],
				'year' => $request['year'],
				'director' => $request['director'],
				'poster' => $request['poster'],
				'synopsis' => $request['synopsis']
				]);
		Notification::success('La película se ha guardado/modificado correctamente');
		return redirect('/catalog/show/'.$id);		
	}	
	public function putRent($id)
	{
		Movie::where('id', $id)
			->update(['rented' => true
				]);
		Notification::success('Pelicula alquilada');
		return redirect('/catalog/show/'.$id);
	}
	public function putReturn($id)
	{
		Movie::where('id', $id)
			->update(['rented' => false
				]);
		Notification::success('Pelicula devuelta');
		return redirect('/catalog/show/'.$id);
	}
	public function deleteMovie($id)
	{
		Movie::where('id', $id)
			->delete();
		Notification::warning('Pelicula eliminada');
		return redirect('/catalog');
	}
}
