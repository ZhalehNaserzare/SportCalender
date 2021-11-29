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
}