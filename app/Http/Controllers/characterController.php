<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Characters;

class characterController extends Controller
{
    public function getAll()
    {
        $characters = Characters::all();
        return response()->json($characters, 200);
    }
    public function getOne($id)
    {
        $character = Characters::find($id);
        return response()->json($character, 200);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image'
        ]);
        $character = Characters::find($id);
        $character->name = $request->name;
        $character->about = $request->about;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/characters', $filename);
            if ($character->image) {
                Storage::delete($character->image);
            }

            $character->image = $path;
        }

        $character->save();

        return response()->json($character, 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'about' => 'required|string',
            'image' => 'required|image'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/characters', $filename);
            $c = Characters::create([
                'name' => $request->name,
                'about' => $request->about,
                'image' => $path
            ]);

            return response()->json($c, 201);
        }

        return response()->json(['message' => 'File tidak ditemukan'], 400);
    }
    public function delete($id)
    {
        $character = Characters::destroy($id);
        return response()->json($character, 204);
    }
}
