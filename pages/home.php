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
        <label for="cars">Choose a car:</label>

        <select id="category-select" class="form-select" aria-label="Default select example">
            <option <?= $categoryId ? '' : 'selected' ?> value="0">Alle</option>
            <?php
                foreach($categories as $category) {
                    echo '<option' . ($categoryId == $category->id ? ' selected' : '')  . ' value="' . $category->id . '">' . $category->name . '</option>';
                }
            ?>
        </select>

        <h2><?= $input->format('F Y') ?></h2>

        <a href="?date=<?= $previousMonth->format('Y-m-d') ?>">back</a>
        <a href="?date=<?= $nextMonth->format('Y-m-d') ?>">next</a>

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
                    $startOdTomorrow = clone $currentDate;
                    $startOdTomorrow->modify('+1 day');
                    $todaysEvents = array_filter($events, function($event) use ($currentDate, $startOdTomorrow) {
                        return $event->dateTime >= $currentDate && $event->dateTime < $startOdTomorrow;
                    });
                    ?>
                        <div class="grid__cell">
                            <div class="crid__cell--title">
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
                    $currentDate = $startOdTomorrow;
                }
            ?>
        </div>
    </div>
</div>