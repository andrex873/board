<?php

namespace Board\Http\Controllers;

use Illuminate\Http\Request;

use Board\Database\Entities\Board;
use Board\Database\Entities\Note;
use Board\Http\Controllers\Controller;
use Board\Http\Requests;
use Board\Transformers\NoteTransformer;
use Validator;

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
     * @param  integer  $boardId
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $boardId)
    {
        $board = Board::find($boardId);

        if ( ! $board ) {
            return $this->respondError('Board does not exist');
        }

        $validator = $this->getStoreValidator($request);

        if ($validator->fails()) {
            return $this->respondError($validator->errors()->getMessages(), 400);
        }

        $note = new Note;
        $note->secure_id = generate_secure_id();
        $note->board_id = $board->id;
        $note->type = $request->type;
        $note->body = $request->body;
        $note->votes = $request->votes;

        if ( ! $note->save() ) {
            return $this->respondServerError('Error creating the Note, please try later');
        }

        return $this->respondSuccess($this->noteTransformer->fromItem($note->toArray()));
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
     * @param  integer  $boardId
     * @param  integer  $noteId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $boardId, $noteId)
    {
        $note = Note::UsingBoard($boardId, $noteId)->first();

        if ( ! $note ) {
            return $this->respondError('Note does not exist');
        }

        $validator = $this->getUpdateValidator($request);

        if ($validator->fails()) {
            return $this->respondError($validator->errors()->getMessages(), 400);
        }

        $note->type = $request->get('type', $note->type);
        $note->body = $request->get('body', $note->body);
        $note->votes = $request->get('votes', $note->votes);

        if ( ! $note->save() ) {
            return $this->respondServerError('Error editing the Note, please try later');
        }

        return $this->respondSuccess($this->noteTransformer->fromItem($note->toArray()));
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

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return Validator
     */
    private function getStoreValidator($request)
    {
        return Validator::make($request->all(),  [
                    'type'  => 'required|in:' . implode(',', array_keys(get_note_types())),
                    'body'  => 'required',
                    'votes' => 'required|integer',
                ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return Validator
     */
    private function getUpdateValidator($request)
    {
        return Validator::make($request->all(),  [
                    'type'  => 'in:' . implode(',', array_keys(get_note_types())),
                    'body'  => '',
                    'votes' => 'integer',
                ]);
    }
}
