<?php

namespace Jalez\SportCalender\Repository;

use Jalez\SportCalender\Classes\Database;
use Jalez\SportCalender\Entity\Location;

class LocationRepository {

    private Database $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    /**
     * @return Location[]
     */
    public function findAll(): array {

        $sql = "SELECT * FROM `location`";

        $resultSet = $this->database->query($sql);

        $locations = [];
        while ($row = $resultSet->fetch_object()) {
            $locations[] = new Location(
                $row->id,
                $row->address,
            );
        }

        return $locations;
    }

    public function create(string $address): ?int {

        $sql = "INSERT INTO location (`address`) VALUES (?)";

        $stmt = $this->database->prepare($sql);
        $stmt->bind_param('s', $address);

        if ($stmt->execute()) {
            return $this->database->getLastInstetedId();
        } else {
            return null;
        }
    }
}