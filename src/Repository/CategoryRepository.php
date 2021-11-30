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
                $row->name,
            );
        }

        return $categories;
    }

    public function create(string $name): ?int {

        $sql = "INSERT INTO category (`name`) VALUES (?)";

        $stmt = $this->database->prepare($sql);
        $stmt->bind_param('s', $name);

        if ($stmt->execute()) {
            return $this->database->getLastInstetedId();
        } else {
            return null;
        }
    }
}