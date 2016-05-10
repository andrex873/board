<?php

namespace Board\Database\Entities;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function board() {
        return $this->belongsTo(Board::class);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  integer $board_Id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromBoard($query, $board_id) {
        return $query->where(compact('board_id'));
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  integer $board_id
     * @param  integer $id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsingBoard($query, $board_id, $id) {
        return $query->where(compact('board_id', 'id'));
    }
}
