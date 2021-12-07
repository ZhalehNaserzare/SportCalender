<?php
declare(strict_types=1);

use Jalez\SportCalender\Entity\Category;
use Jalez\SportCalender\Repository\CategoryRepository;
use PHPUnit\Framework\TestCase;

final class CategoryRepositoryTest extends TestCase {

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv\Dotenv::createImMutable(__DIR__ . '\..');
        $dotenv->load();
        parent::setUpBeforeClass();
    }

    public function testGetListIsListOfCategoryObbjects(): void {
        $repository = new CategoryRepository();
        $categories = $repository->findAll();
        foreach($categories as $category) {
            $this->assertInstanceOf(Category::class, $category);
        }
    }

    public function testCrerate(): void {
        $repository = new CategoryRepository();
        $categoryCountBefore = count($repository->findAll());

        $id = $repository->create('testName1');

        $categoryCountAfter = count($repository->findAll());

        $this->assertEquals($categoryCountBefore + 1, $categoryCountAfter);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
    }
}