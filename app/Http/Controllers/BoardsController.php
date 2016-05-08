<?php

namespace Board\Http\Controllers;

use Illuminate\Http\Request;

use Board\Database\Entities\Board;
use Board\Http\Controllers\Controller;
use Board\Http\Requests;
use Board\Transformers\BoardTransformer;

class BoardsController extends Controller
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

        return response()->json([
                'status_code' => 200,
                'data' => $this->boardTransformer->fromCollection($boards->toArray()),
            ], 200);
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

            return response()->json([
                    'error' => [
                        'message' => 'Board does not exist',
                        'status_code' => 404
                    ]
                ], 404);
        }

        return response()->json([
                'status_code' => 200,
                'data' => $this->boardTransformer->fromItem($board->toArray()),
            ], 200);
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
