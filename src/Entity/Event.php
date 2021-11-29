<?php

namespace Jalez\SportCalender\Entity;

use DateTime;


class Event {
    public int $id;
    public DateTime $dateTime;
    public Team $firstTeam;
    public Team $secondTeam;
    public Location $location;
    public Category $category;

    public function __construct(int $id, DateTime $dateTime, Team $team1, Team $team2, Location $location, Category $category) {
        $this->id = $id;
        $this->dateTime = $dateTime;
        $this->firstTeam = $team1;
        $this->secondTeam = $team2;
        $this->location = $location;
        $this->category = $category;
    }
}
