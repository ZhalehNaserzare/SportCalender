<?php

namespace Jalez\SportCalender\Repository;

use Jalez\SportCalender\Classes\Database;
use Jalez\SportCalender\Entity\Category;
use Jalez\SportCalender\Entity\Event;
use Jalez\SportCalender\Entity\Location;
use Jalez\SportCalender\Entity\Team;

class EventRepository {

    private Database $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    /**
     * @return Event[]
     */
    public function findAll(): array {

        $sql = "
            SELECT
                e.id AS e_id,
                e.date AS e_datetime,
                t1.id AS t1_id,
                t1.team_name AS t1_team_name,
                t1.number AS t1_number,
                t2.id AS t2_id,
                t2.team_name AS t2_team_name,
                t2.number AS t2_number,
                l.id AS l_id,
                l.address AS l_address,
                c.id AS c_id,
                c.category_name AS c_category_name
            FROM event
                e
            INNER JOIN team t1 ON e._id_first_team = t1.id
            INNER JOIN team t2 ON e._id_second_team = t2.id
            INNER JOIN location l ON e._id_locatin = l.id
            INNER JOIN category c ON e._id_category = c.id
        ";

        $resultSet = $this->database->query($sql);

        $events = [];
        while ($row = $resultSet->fetch_object()) {
            $events[] = new Event(
                $row->e_id,
                new \DateTime($row->e_datetime),
                new Team(
                    $row->t1_id,
                    $row->t1_team_name,
                    $row->t1_number,
                ),
                new Team(
                    $row->t2_id,
                    $row->t2_team_name,
                    $row->t2_number,
                ),
                new Location(
                    $row->l_id,
                    $row->l_address,
                ),
                new Category(
                    $row->c_id,
                    $row->c_category_name,
                ),
            );
        }

        return $events;
    }
}