<?php

namespace Jalez\SportCalender\Repository;

use Jalez\SportCalender\Classes\Database;
use Jalez\SportCalender\Entity\Category;

class CategoryRepository {

    private Database $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    /**
     * @return Category[]
     */
    public function findAll(): array {

        $sql = "SELECT * FROM category";

        $resultSet = $this->database->query($sql);

        $categories = [];
        while ($row = $resultSet->fetch_object()) {
            $categories[] = new Category(
                $row->id,
                $row->category_name,
            );
        }

        return $categories;
    }
}