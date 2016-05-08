<?php

namespace Board\Transformers;

abstract class Transformer {

    public function fromCollection (array $list) {
        return array_map([$this, 'fromItem'], $list);
    }

    public abstract function fromItem($item);

}