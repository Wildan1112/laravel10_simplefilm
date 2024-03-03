<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $status = Status::orderBy('name')->get();
        return view('pages.status.index', compact('status'));
    }

    public function create()
    {
        return view('pages.status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Status::create($data);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Status Created Successfully!'
        );

        return redirect()->route('status.index')->with($notification);
    }

    public function edit(Status $status)
    {
        return view('pages.status.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $status->update($data);

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Status Updated Successfully!'
        );

        return redirect()->route('status.index')->with($notification);
    }

    public function destroy(Status $status)
    {
        $status->delete();
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Data Status Deleted Successfully!'
        );

        return redirect()->route('status.index')->with($notification);
    }
}
