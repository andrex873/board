<?php

namespace Board\Transformers;


class NoteTransformer extends Transformer {

    public function fromItem($note) {
        return [
            'id' => $note['id'],
            'board_id' => $note['board_id'],
            'type' => $note['type'],
            'body' => $note['body'],
            'votes' => $note['votes'],
            'actions' => [
                'show' => route('api.v1.boards.notes.show', [$note['board_id'], $note['id']]),
                'delete' => route('api.v1.boards.notes.destroy', [$note['board_id'], $note['id']]),
            ]
        ];
    }

}