<?php

namespace Board\Http\Controllers;

use Illuminate\Http\Request;

use Board\Http\Requests;
use Board\Http\Controllers\Controller;
use Board\Transformers\NoteTransformer;
use Board\Database\Entities\Note;

class NotesController extends ApiController
{

    /**
     * Transformer for the Note entitie.
     *
     * @var \Board\Transformers\NoteTransformer
     */
    protected $noteTransformer;

    /**
     * Contructor for the Notes controller.
     *
     * @param \Board\Transformers\NoteTransformer $noteTransformer
     */
    function __construct(NoteTransformer $noteTransformer) {
        $this->noteTransformer = $noteTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($boardId)
    {
        $notes = Note::fromBoard($boardId)->get();

        return $this->noteTransformer->fromCollection($notes->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($boardId, $noteId)
    {
        $note = Note::UsingBoard($boardId, $noteId)->first();

        if ( ! $note ) {
            return $this->respondError('Note does not exist');
        }

        return $this->respondSuccess($this->noteTransformer->fromItem($note->toArray()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($boardId, $noteId)
    {
        $note = Note::usingBoard($boardId, $noteId)->first();

        if ( ! $note ) {
            return $this->respondError('Note does not exist');
        }

        if ( ! $note->delete() ) {
            return $this->respondServerError('Error deleting the Note, please try later');
        }

        return $this->respondSuccess([], 204);
    }
}
