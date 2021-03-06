<?php

namespace Board\Http\Controllers;

use Illuminate\Http\Request;

use Board\Database\Entities\Board;
use Board\Http\Controllers\ApiController;
use Board\Http\Requests;
use Board\Transformers\BoardTransformer;

class BoardsController extends ApiController
{

    /**
     * Transformer for the Board entitie.
     *
     * @var \Board\Transformers\BoardTransformer
     */
    protected $boardTransformer;

    /**
     * Contructor for the Board controller.
     *
     * @param \Board\Transformers\BoardTransformer $boardTransformer
     */
    function __construct(BoardTransformer $boardTransformer) {
        $this->boardTransformer = $boardTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $boards = Board::all();

        return $this->respondSuccess(
            $this->boardTransformer->fromCollection($boards->toArray()),
            200,
            $this->getCallback($request)
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;

        if ( ! $name ) {
            return $this->respondError('Client error, review the request', 400, $this->getCallback($request));
        }

        $board = new Board;
        $board->name = $name;
        $board->secure_id = generate_secure_id();

        if ( ! $board->save() ) {
            return $this->respondServerError('Error creating the Board, please try later');
        }

        return $this->respondSuccess($this->boardTransformer->fromItem($board->toArray()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $board = Board::find($id);

        if ( ! $board ) {
            return $this->respondError('Board does not exist');
        }

        return $this->respondSuccess(
            $this->boardTransformer->fromItem($board->toArray()),
            200,
            $this->getCallback($request)
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $board = Board::find($id);

        if ( ! $board ) {
            return $this->respondError('Board does not exist', 404, $this->getCallback($request));
        }

        if ( ! $board->delete() ) {
            return $this->respondServerError('Error deleting the Board, please try later', 500, $this->getCallback($request));
        }

        return $this->respondSuccess([], 204, $this->getCallback($request));
    }

    /**
     * Get the callback name if the request is JSONP
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    private function getCallback($request)
    {
        return $request->has('callback') ? $request->callback : null;
    }

}
