<?php

namespace Jalez\SportCalender\Repository;

use Jalez\SportCalender\Classes\Database;
use Jalez\SportCalender\Entity\Team;

class TeamRepository {

    private Database $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    /**
     * @return Team[]
     */
    public function findAll(): array {

        $sql = "SELECT * FROM team";

        $resultSet = $this->database->query($sql);

        $teams = [];
        while ($row = $resultSet->fetch_object()) {
            $teams[] = new Team(
                $row->id,
                $row->team_name,
                $row->homecity,
            );
        }

        return $teams;
    }

    public function create(string $name, string $homecity): ?int {

        $sql = "INSERT INTO team (team_name, homecity) VALUES (?, ?)";

        $stmt = $this->database->prepare($sql);
        $stmt->bind_param('ss', $name, $homecity);

        if ($stmt->execute()) {
            return $this->database->getLastInstetedId();
        } else {
            return null;
        }
    }
}