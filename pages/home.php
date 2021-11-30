<?php

use Jalez\SportCalender\Repository\EventRepository;
use Jalez\SportCalender\Repository\CategoryRepository;

$eventRepository = new EventRepository();
$categoryRepository = new CategoryRepository();

$categories = $categoryRepository->findAll();

$categoryId = ($_GET['categoryId'] ?? null) ?: null;

$input = new DateTime($_GET['date'] ?? 'now');
$input->modify('first day of this month');

$previousMonth = clone $input;
$previousMonth->modify('-1 month');

$nextMonth = clone $input;
$nextMonth->modify('+1 month');

?>
<div class="padding-wrapper">
    <div class="container">
        <h1>Sportcalendar</h1>
        <div class="form-group row">
            <label for="category-select" class="col-sm-2 col-form-label">Choose a category: </label>         
            <select id="category-select" class="col-sm-3 form-control" aria-label="Default select example">
                <option <?= $categoryId ? '' : 'selected' ?> value="0">Alle</option>
                <?php
                    foreach($categories as $category) {
                        echo '<option' . ($categoryId == $category->id ? ' selected' : '')  . ' value="' . $category->id . '">' . $category->name . '</option>';
                    }
                ?>
            </select>
            <div class="col-sm-7">
                <a href="?page=add-event" class="btn btn-primary">Add Event</a><br />
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="row">
                    <div class="col-6">
                        <a class="navigation-icon" href="?date=<?= $previousMonth->format('Y-m-d') ?>"><i class="fas fa-chevron-left"></i></a>
                    </div>
                    <div class="col-6">
                        <a class="navigation-icon" href="?date=<?= $nextMonth->format('Y-m-d') ?>"><i class="fas fa-chevron-right"></i></a>
                    </div>   
                </div>  
            </div>
            <div class="col-10">
                <h2><?= $input->format('F Y') ?></h2>
            </div>    
        </div>
        <div class="grid">
            <?php

                $currentDate = clone $input;
                $currentDate->setTime(0, 0, 0);
                $currentDate->modify('monday this week');

                $endDate = clone $input;
                $endDate->modify('last day of this month');
                $endDate->setTime(0, 0, 0);
                $endDate->modify('sunday this week');


                $events = $eventRepository->findAllInRange($currentDate, $endDate, $categoryId);


                while ($currentDate <= $endDate) {
                    $startOfTomorrow = clone $currentDate;
                    $startOfTomorrow->modify('+1 day');
                    $todaysEvents = array_filter($events, function($event) use ($currentDate, $startOfTomorrow) {
                        return $event->dateTime >= $currentDate && $event->dateTime < $startOfTomorrow;
                    });
                    ?>
                        <div class="grid__cell">
                            <div class="crid__cell--title" style="background-color:LightGray;">
                                <?= $currentDate->format('j') ?>
                            </div>
                            <?php 
                                foreach($todaysEvents as $event) {
                                    ?>
                                    <div class="event">
                                        <span class="event__time"><?= $event->dateTime->format('H:i') ?></span>
                                        <span class="event__title"><?= $event->firstTeam->name ?> - <?= $event->secondTeam->name ?></span>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    <?php
                    $currentDate = $startOfTomorrow;
                }
            ?>
        </div>
    </div>
</div>