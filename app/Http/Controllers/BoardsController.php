<?php

namespace Board\Http\Controllers;

use Illuminate\Http\Request;

use Board\Database\Entities\Board;
use Board\Http\Controllers\ApiController;
use Board\Http\Requests;
use Board\Transformers\BoardTransformer;

class BoardsController extends ApiController
{

    protected $boardTransformer;

    function __construct(BoardTransformer $boardTransformer) {
        $this->boardTransformer = $boardTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::all();

        return $this->respondSuccess($this->boardTransformer->fromCollection($boards->toArray()));
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
    public function show($id)
    {
        $board = Board::find($id);

        if ( ! $board ) {
            return $this->respondNotFound('Board does not exist');
        }

        return $this->respondSuccess($this->boardTransformer->fromItem($board->toArray()));
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
    public function destroy($id)
    {
        //
    }

}
