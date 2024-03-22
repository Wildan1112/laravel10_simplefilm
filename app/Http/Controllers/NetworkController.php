<?php

namespace App\Http\Controllers;

use App\Exports\NetworksExport;
use App\Imports\NetworksImport;
use App\Models\Network;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NetworkController extends Controller
{
    public function index()
    {
        $networks = Network::all();
        return view('pages.network.index', compact('networks'));
    }

    public function create()
    {
        return view('pages.network.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Network::create($data);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Network Created Successfully!'
        );

        return redirect()->route('network.index')->with($notification);
    }

    public function edit(Network $network)
    {
        return view('pages.network.edit', compact('network'));
    }

    public function update(Request $request, Network $network)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $network->update($data);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Network Updated Successfully!'
        );

        return redirect()->route('network.index')->with($notification);
    }

    public function destroy(Network $network)
    {
        $network->delete();
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Network Deleted Successfully!'
        );

        return redirect()->route('network.index')->with($notification);
    }
    public function import()
    {
        return view('pages.network.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new NetworksImport, request()->file('file'));

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Network Imported Successfully!'
        );

        return redirect()->route('network.index')->with($notification);
    }

    public function export()
    {
        return Excel::download(new NetworksExport, 'data-network.xlsx');
    }
}
