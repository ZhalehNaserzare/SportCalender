<?php
use Jalez\SportCalender\Repository\LocationRepository;
use Jalez\SportCalender\Repository\CategoryRepository;
use Jalez\SportCalender\Repository\EventRepository;
use Jalez\SportCalender\Repository\TeamRepository;

$eventRepository = new EventRepository();


if (isset($_POST['submit'])) {
    $firstTeamId = $_POST['firstTeamId'] ?? null;
    $secondTeamId = $_POST['secondTeamId'] ?? null;
    $locationId = $_POST['locationId'] ?? null;
    $categoryId = $_POST['categoryId'] ?? null;
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;

    $dateTime = new DateTime("$date $time");

    $eventRepository->create($dateTime, $firstTeamId, $secondTeamId, $locationId, $categoryId);

    header('Location: ./?');
}

$locationRepository = new LocationRepository();
$categoryRepository = new CategoryRepository();
$teamRepository = new TeamRepository();

$locations = $locationRepository->findAll();
$categories = $categoryRepository->findAll();
$teams = $teamRepository->findAll();


?>
<div class="container padding-wrapper" id ="addEventContainer">
    <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" id="create-category-btn" class="btn btn-light">Create Category</button>
        <button type="button" id="create-team-btn" class="btn btn-light">Create Team</button>
        <button type="button" id="create-location-btn" class="btn btn-light">Create Location</button>
    </div>
    <h3 id="headTitle" class="font-italic mt-3">Add Event</h3>
    <form id="addEventForm" action="./?page=add-event" method="POST" class="form-group">
        <div class="row">
            <div class="col-12 col-lg-6 mt-3">
                <label for="categoryId">Event Category</label>
                <select type="text" name="categoryId" class="form-control custom-select mr-sm-2" id="categoryId" required>
                <?php
                        foreach ($categories as $category) {
                            echo '<option value="' . $category->id . '">' . $category->name . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-lg-6"> </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="SelectFirstTeam">First Team</label>
                <select type="text" name="firstTeamId" class="form-control custom-select mr-sm-2" id="firstteam" required>
                <?php
                        foreach ($teams as $team) {
                            echo '<option value="' . $team->id . '">' . $team->name . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <label for="SelectFirstTeam">Second Team</label>
                <select type="text" name="secondTeamId" class="form-control custom-select mr-sm-2" id="Secondteam" required>
                    <?php
                        foreach ($teams as $team) {
                            echo '<option value="' . $team->id . '">' . $team->name . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <div class="row">
                    <div class="col-7">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="col-5">
                        <label for="time">Time</label>
                        <input type="time" name="time" id="time" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                    <label for="SelectLocation">Location</label>
                    <select type="text" name="locationId" class="form-control custom-select mr-sm-2" id="SelectLocation" required>
                        <?php
                            foreach ($locations as $location) {
                                echo '<option value="' . $location->id . '">' . $location->address . '</option>';
                            }
                        ?>
                    </select>
            </div>
            <div class="col-2 mt-4">
                <button type="submit" name="submit" value="submit" class="w-100 btn btn-primary">Save Event</button>
            </div>
            <div class="col-2 mt-4">
                <a href="./" class="w-100 btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>