<?php

namespace Board\Database\Entities;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes() {
        return $this->hasMany(Note::class);
    }
}
