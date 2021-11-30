<?php

namespace Jalez\SportCalender\Repository;

use DateTime;
use DateTimeInterface;
use Exception;
use Jalez\SportCalender\Classes\Database;
use Jalez\SportCalender\Entity\Category;
use Jalez\SportCalender\Entity\Event;
use Jalez\SportCalender\Entity\Location;
use Jalez\SportCalender\Entity\Team;

class EventRepository {

    public const EXCEPTION_TEAM_IDS_ARE_EQUAL = 36981;

    private Database $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    /**
     * @return Event[]
     */
    public function findAllInRange(?DateTime $startDate = null, ?DateTime $endDate = null, ?int $categoryId = null): array {

        $sql = '
            SELECT
                e.id AS e_id,
                e.date AS e_datetime,
                t1.id AS t1_id,
                t1.team_name AS t1_team_name,
                t1.homecity AS t1_homecity,
                t2.id AS t2_id,
                t2.team_name AS t2_team_name,
                t2.homecity AS t2_homecity,
                l.id AS l_id,
                l.address AS l_address,
                c.id AS c_id,
                c.name AS c_name
            FROM event
                e
            INNER JOIN team t1 ON e._id_first_team = t1.id
            INNER JOIN team t2 ON e._id_second_team = t2.id
            INNER JOIN location l ON e._id_location = l.id
            INNER JOIN category c ON e._id_category = c.id
            ';
        if ($startDate && $endDate) {
            $sql .= '
            WHERE 
                e.date >= STR_TO_DATE("' . $startDate->format('Y-m-d'). '", "%Y-%m-%d") AND
                e.date <= STR_TO_DATE("' . $endDate->format('Y-m-d 23:59:59'). '", "%Y-%m-%d %H:%i:%s")
            ';
            if ($categoryId) {
                $categoryId = $this->database->escape($categoryId);
                $sql .= "
                    AND c.id = $categoryId
                ";
            }
        }
        $sql .= '
            ORDER BY e.date ASC
        ';

        $resultSet = $this->database->query($sql);

        $events = [];
        while ($row = $resultSet->fetch_object()) {
            $events[] = new Event(
                $row->e_id,
                new \DateTime($row->e_datetime),
                new Team(
                    $row->t1_id,
                    $row->t1_team_name,
                    $row->t1_homecity,
                ),
                new Team(
                    $row->t2_id,
                    $row->t2_team_name,
                    $row->t2_homecity,
                ),
                new Location(
                    $row->l_id,
                    $row->l_address,
                ),
                new Category(
                    $row->c_id,
                    $row->c_name,
                ),
            );
        }

        return $events;
    }

    /**
     * @throws Exception with code self::EXCEPTION_TEAM_IDS_ARE_EQUAL if the team IDs are equal
     */
    public function create(DateTime $dateTime, int $team1id, int $team2id, int $locationId, int $categoryId): ?int {

        if ($team1id == $team2id) {
            throw new Exception('Team IDs must be different', self::EXCEPTION_TEAM_IDS_ARE_EQUAL);
        }

        $sql = "INSERT INTO event (`date`, _id_first_team, _id_second_team, _id_category, _id_location) VALUES (?, ?, ?, ?, ?)";

        $dateTimeString = $dateTime->format(DateTimeInterface::ISO8601);
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param('siiii', 
            $dateTimeString,
            $team1id,
            $team2id,
            $locationId,
            $categoryId,
        );

        if ($stmt->execute()) {
            return $this->database->getLastInstetedId();
        } else {
            return null;
        }
    }
}