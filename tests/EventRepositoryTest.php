<?php
declare(strict_types=1);

use Jalez\SportCalender\Entity\Event;
use Jalez\SportCalender\Repository\EventRepository;
use PHPUnit\Framework\TestCase;

final class EventRepositoryTest extends TestCase {

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv\Dotenv::createImMutable(__DIR__ . '\..');
        $dotenv->load();
        parent::setUpBeforeClass();
    }
    
    public function testGetListIsListOfEventObbjects(): void {
        $repository = new EventRepository();
        $events = $repository->findAllInRange();
        foreach($events as $event) {
            $this->assertInstanceOf(Event::class, $event);
        }
    }

    public function testGetListRange1(): void {
        $repository = new EventRepository();
        $start = new DateTime('1999-10-23 00:00');
        $end = new DateTime('1999-11-30 00:00');

        $eventCountStart = count($repository->findAllInRange($start, $end));
        $repository->create($start, 1, 2, 1, 1);
        $eventCountEnd = count($repository->findAllInRange($start, $end));

        $this->assertEquals($eventCountStart + 1, $eventCountEnd);
    }

    public function testGetListRange2(): void {
        $repository = new EventRepository();
        $start = new DateTime('1999-10-23 00:00');
        $end = new DateTime('1999-11-30 00:00');

        $eventCountStart = count($repository->findAllInRange($start, $end));
        $repository->create($end, 1, 2, 1, 1);
        $eventCountEnd = count($repository->findAllInRange($start, $end));

        $this->assertEquals($eventCountStart + 1, $eventCountEnd);
    }

    public function testGetListRange3outsideRange(): void {
        $repository = new EventRepository();
        $start = new DateTime('1999-10-23 00:00');
        $end = new DateTime('1999-11-30 00:00');
        $eventDate = new DateTime('1999-10-22 23:59:59');

        $eventCountStart = count($repository->findAllInRange($start, $end));
        $repository->create($eventDate, 1, 2, 1, 1);
        $eventCountEnd = count($repository->findAllInRange($start, $end));

        $this->assertEquals($eventCountStart, $eventCountEnd);
    }

    public function testGetListRange4outsideRange(): void {
        $repository = new EventRepository();
        $start = new DateTime('1999-10-23 00:00');
        $end = new DateTime('1999-11-30 00:00');
        $eventDate = new DateTime('1999-12-01 00:00');

        $eventCountStart = count($repository->findAllInRange($start, $end));
        $repository->create($eventDate, 1, 2, 1, 1);
        $eventCountEnd = count($repository->findAllInRange($start, $end));

        $this->assertEquals($eventCountStart, $eventCountEnd);
    }

    public function testCreateThrowsIfTeamsAreEqual(): void {
        $repository = new EventRepository();
        $eventDate = new DateTime('1999-12-01 00:00');

        $this->expectException(Exception::class);
        $this->expectExceptionCode(EventRepository::EXCEPTION_TEAM_IDS_ARE_EQUAL);

        $repository->create($eventDate, 1, 1, 1, 1);
    }
}
