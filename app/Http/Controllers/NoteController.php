<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::query()
        ->where('user_id', request()->user()->id)
            ->orderBy('created_at','desc')
            ->paginate();
        // dd($notes);
        return view('note.index',['notes'=> $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'note' => ['required','string']
        ]);

        $data['user_id']=$request->user()->id;

        $note = Note::create($data);

        return to_route('note.show',$note)->with ('message', 'Note Was Create' );
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {

        // check relevant user id
        if ($note->user_id !== request()->user()->id){
            abort(403);
        }


        
        return view('note.show',['note'=> $note]);
        // return 'show' . $id; --show with passing id but function rechange for ->  public function show ($string $id)  like 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user_id !== request()->user()->id){
            abort(403);
        }
        return view('note.edit',['note'=> $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {

        // check relevant user id
        if ($note->user_id !== request()->user()->id){
            abort(403);
        }



        $data = $request->validate([
            'note' => ['required','string']
        ]);

        $data['user_id']=1;

        $note ->update($data);

        return to_route('note.show',$note)->with ('message', 'Note Was Updated' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        // check relevant user id

        if ($note->user_id !== request()->user()->id){
            abort(403);
        }





        $note->delete();

        return to_route('note.index',$note)->with ('message', 'Note Was Deleted' );
    }
}
