<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function create()
    {
        return view('admin.admin_add_berita');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|unique:beritas,slug',
        ]);

        $data = Berita::create($request->all());

        if ($request->file('image')) {
            $request->file('image')->move('img-berita/', $request->file('image')->getClientOriginalName());
            $data->image = $request->file('image')->getClientOriginalName();
            $data->save();
        }

        return redirect()->back()->with('success', 'Berita created successfully.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.admin_edit_berita', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|unique:beritas,slug,' . $berita->id,
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($berita->image) {
                Storage::delete('img-berita/' . $berita->image);
            }
            $request->file('image')->move('img-berita/', $request->file('image')->getClientOriginalName());
            $data['image'] = $request->file('image')->getClientOriginalName();
        }

        $berita->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Berita updated successfully.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->image) {
            Storage::delete('img-berita/' . $berita->image);
        }
        $berita->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Berita deleted successfully.');
    }

    public function index()
    {
        $beritas = Berita::all();
        return view('user.berita', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('user.detail_berita', compact('berita'));
    }
}
