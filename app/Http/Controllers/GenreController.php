<?php

namespace App\Http\Controllers;

use App\Exports\GenresExport;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GenresImport;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy('name')->paginate(10);
        return view('pages.genre.index', compact('genres'));
    }

    public function create()
    {
        return view('pages.genre.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Genre::create($data);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Genre Created Successfully!'
        );

        return redirect()->route('genre.index')->with($notification);
    }

    public function edit(Genre $genre)
    {
        return view('pages.genre.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|unique:genres',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $genre->update($data);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Genre Updated Successfully!'
        );

        return redirect()->route('genre.index')->with($notification);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Genre Deleted Successfully!'
        );

        return redirect()->route('genre.index')->with($notification);
    }

    public function import()
    {
        return view('pages.genre.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new GenresImport, request()->file('file'));

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Genre Imported Successfully!'
        );

        return redirect()->route('genre.index')->with($notification);
    }

    public function export()
    {
        return Excel::download(new GenresExport, 'data-genre.xlsx');
    }
}
