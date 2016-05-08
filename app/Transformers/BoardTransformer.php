<?php

namespace Board\Transformers;


class BoardTransformer extends Transformer {

    public function fromItem($board) {
        return [
            'id' => $board['id'],
            'name' => $board['name'],
            'last_update' => $board['updated_at'],
        ];
    }

}