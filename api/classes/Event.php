<?php
require_once("Team.php");
require_once("Location.php");
require_once("Category.php");
class Event{
    public int $id;
    public ?DateTime $eventDatetime;
    public ?Team $firstTeam;
    public ?Team $secondTeam;
    public ?Location $location;
    public ?Category $category;
}

?>