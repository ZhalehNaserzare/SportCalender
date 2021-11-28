<?php
class Category{
    public int $id;
    public string $category_name;

    function __construct($id, $category)
    {
        $this->id = $id;
        $this->category_name = $category;
    }
}

?>