<?php

namespace Board\Transformers;


class BoardTransformer extends Transformer {

    public function fromItem($board) {
        return [
            'id' => $board['id'],
            'name' => $board['name'],
            'last_update' => $board['updated_at'],
            'actions' => [
                'show' => route('api.v1.boards.show', $board['id']),
                'delete' => route('api.v1.boards.destroy', $board['id'])
            ]
        ];
    }

}