<?php

use PHPUnit\Framework\TestCase;

use Maherio\Lyceum\Entity\Domain;
use Maherio\Lyceum\Entity\GradeLevel;
use Maherio\Lyceum\Entity\Student;
use Maherio\Lyceum\Entity\UnitOfStudy;

class StudentTest extends TestCase {
    protected $domains;
    protected $levels;
    protected $testScores;

    protected function setUp() {
        $this->domains = [
            'test',
            'RI',
        ];
        $this->levels = [
            '1',
            '3',
        ];

        for($index = 0; $index < count($this->domains); ++$index) {
            $domain = new Domain($this->domains[$index]);
            $level = new GradeLevel($this->levels[$index]);
            $this->testScores[] = new UnitOfStudy($domain, $level);
        }
    }

    public function testInstantiable() {
        $name = 'name';
        $student = new Student($name, $this->testScores);

        $this->assertInstanceOf(Student::class, $student);
    }

    public function testGetsName() {
        $name = 'name';
        $student = new Student($name, $this->testScores);

        $this->assertEquals($name, $student->getName());
    }

    public function testGetsGradeLevel() {
        $name = 'name';
        $student = new Student($name, $this->testScores);

        for($index = 0; $index < count($this->domains); ++$index) {
            $domain = new Domain($this->domains[$index]);
            $level = new GradeLevel($this->levels[$index]);

            $this->assertEquals($level, $student->getGradeLevel($domain));
        }
    }
}
