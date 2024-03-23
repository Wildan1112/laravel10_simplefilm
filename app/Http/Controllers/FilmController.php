<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Network;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::with('status')->latest()->paginate(25);
        return view('pages.film.index', compact('films'));
    }

    public function show(Film $film)
    {
        return view('pages.film.show', compact('film'));
    }

    public function create()
    {
        $status = Status::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $networks = Network::orderBy('name')->get();
        return view('pages.film.create', compact('status', 'genres', 'types', 'networks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'poster' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'synopsis' => 'required|string',
            'status_id' => 'required',
            'type_id' => 'required',
            'network_id' => 'required',
            'genres' => 'array'
        ]);

        $slug = Str::slug($request->title);

        // Generate nama file gambar
        $fileName = date('Ymd') . '_' . $slug . '.' . $request->poster->extension();

        // Simpan gambar ke storage
        $request->poster->storeAs('public/posters', $fileName);

        $film = Film::create([
            'title' => $request->title,
            'slug' => $slug,
            'poster' => $fileName,
            'synopsis' => $request->synopsis,
            'status_id' => $request->status_id,
            'type_id' => $request->type_id,
            'network_id' => $request->network_id,
        ]);
        // Attach genres
        $film->genres()->attach($request->genres);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Film Created Successfully!'
        );

        return redirect()->route('film.index')->with($notification);
    }

    public function edit(Film $film)
    {
        $status = Status::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $networks = Network::orderBy('name')->get();
        return view('pages.film.edit', compact('film', 'status', 'genres', 'types', 'networks'));
    }
    public function update(Request $request, Film $film)
    {
        $request->validate([
            'title' => 'required',
            'poster' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'synopsis' => 'required|string',
            'status_id' => 'required',
            'type_id' => 'required',
            'network_id' => 'required',
            'genres' => 'array'
        ]);

        $slug = Str::slug($request->title);
        if ($request->hasFile('poster')) {
            $fileName = date('Ymd') . '_' . $slug . '.' . $request->poster->extension();
            // Upload & Save poster ke storage
            $request->poster->storeAs('public/posters', $fileName);

            //delete old poster
            Storage::delete('public/posters/' . $film->poster);

            // update film with poster
            $film->update([
                'title' => $request->title,
                'slug' => $slug,
                'poster' => $fileName,
                'synopsis' => $request->synopsis,
                'status_id' => $request->status_id,
                'type_id' => $request->type_id,
                'network_id' => $request->network_id,
            ]);
        } else {
            // without poster
            $film->update([
                'title' => $request->title,
                'slug' => $slug,
                'synopsis' => $request->synopsis,
                'status_id' => $request->status_id,
                'type_id' => $request->type_id,
                'network_id' => $request->network_id,
            ]);
        }

        $film->genres()->sync($request->genres);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Film Updated Successfully!'
        );
        return redirect()->route('film.index')->with($notification);
    }

    public function destroy(Film $film)
    {
        Storage::delete('public/posters/' . $film->poster);

        $film->delete();
        $film->genres()->detach();

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Film Deleted Successfully!'
        );
        return redirect()->route('film.index')->with($notification);
    }
}
