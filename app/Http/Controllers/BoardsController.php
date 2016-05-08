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

        return $this->responseSuccess($this->boardTransformer->fromCollection($boards->toArray()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            return $this->responseNotFound('Board does not exist');
        }

        return $this->responseSuccess($this->boardTransformer->fromItem($board->toArray()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
