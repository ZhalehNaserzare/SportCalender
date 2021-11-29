<?php

use Jalez\SportCalender\Repository\EventRepository;
use Jalez\SportCalender\Repository\CategoryRepository;

$eventRepository = new EventRepository();
$categoryRepository = new CategoryRepository();

$categories = $categoryRepository->findAll();

$events = $eventRepository->findAll();

?>
<div class="padding-wrapper">
    <div class="container">
        <h1>Sportcalendar</h1>
        <label for="cars">Choose a car:</label>

        <select class="form-select" aria-label="Default select example">
            <option selected>Alle</option>
            <?php
                foreach($categories as $category) {
                    echo '<option selected>' . $category->name . '</option>';
                }
            ?>
        </select>

        <div id="calendar" class="row">
            <div class="col-2 p-1">Datum</div>
            <div class="col-1 p-1">Uhrzeit</div>
            <div class="col-2 p-1">Kategorie</div>
            <div class="col-3 p-1">Team1</div>
            <div class="col-3 p-1">Team2</div>
            <div class="col-1 p-1"> </div>
            <?php
                foreach($events as $event) {
                    ?>
                    <div class="col-2 p-1"><?= $event->dateTime->format('m/d/Y') ?></div>
                    <div class="col-1 p-1"><?= $event->dateTime->format('i:H') ?></div>
                    <div class="col-2 p-1"><?= $event->category->name ?></div>
                    <div class="col-3 p-1">
                        <span data-toggle="tooltip"data-placement="top" title="<?= $event->firstTeam->homecity ?>">
                            <?= $event->firstTeam->name ?>
                        </span>
                    </div>
                    <div class="col-3 p-1">
                        <span data-toggle="tooltip"data-placement="top" title="<?= $event->firstTeam->homecity ?>">
                            <?= $event->secondTeam->name ?>
                        </span>
                    </div>
                    <div class="col-1 p-1"> </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>