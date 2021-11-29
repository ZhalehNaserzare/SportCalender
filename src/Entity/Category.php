<?php

namespace Jalez\SportCalender\Entity;

class Category {
    public int $id;
    public string $category_name;

    function __construct(int $id, string $category) {
        $this->id = $id;
        $this->category_name = $category;
    }
}

?>