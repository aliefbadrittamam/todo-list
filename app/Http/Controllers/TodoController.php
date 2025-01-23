<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = todo::orderBy('created_at', 'desc')->get();

        return view('todo', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:25'


        ], [
            'title.required' => 'inputan harus di isi',
            'title.min' => 'minimal 3 huruf',
            'title.max' => 'maximal 25 huruf tidak bisa lebih'
        ]);

        todo::create([
            'title' => $request->title,

        ]);

        return redirect()
            ->route('todo')
            ->with('success', " todo dengan nama " . $request->title . "berhasil di tambahkan");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:25'
            


        ], [
            'title.required' => 'inputan harus di isi',
            'title.min' => 'minimal 3 huruf',
            'title.max' => 'maximal 25 huruf tidak bisa lebih'
        ]);

        $data = [
            'title' => $request->input('title'),
            'is_done' => $request->input('is_done'),
        ];

        todo::where('todo_id', $id)->update($data);
        return redirect()->route('todo')->with('success', 'data telah berhasil di update');
    }


    public function destroy(string $id)
    {
        todo::where('todo_id', $id)->delete();
        return redirect()->route('todo')->with('success', 'data telah berhasil di destroy');
    }
}
