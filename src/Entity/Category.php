<?php

namespace Jalez\SportCalender\Entity;

class Category {
    public int $id;
    public string $name;

    function __construct(int $id, string $category) {
        $this->id = $id;
        $this->name = $category;
    }
}
