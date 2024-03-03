<?php

namespace App\Http\Controllers;

use App\Exports\TypesExport;
use App\Imports\TypesImport;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::orderBy('name')->get();
        return view('pages.type.index', compact('types'));
    }
    public function create()
    {
        return view('pages.type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Type::create($data);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Type Created Successfully!'
        );

        return redirect()->route('type.index')->with($notification);
    }

    public function edit(Type $type)
    {
        return view('pages.type.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $type->update($data);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Type Updated Successfully!'
        );

        return redirect()->route('type.index')->with($notification);
    }

    public function destroy(Type $type)
    {
        $type->delete();
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Type Deleted Successfully!'
        );

        return redirect()->route('type.index')->with($notification);
    }

    public function import()
    {
        return view('pages.type.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new TypesImport, request()->file('file'));

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Type Imported Successfully!'
        );

        return redirect()->route('type.index')->with($notification);
    }

    public function export()
    {
        return Excel::download(new TypesExport, 'data-type.xlsx');
    }
}
