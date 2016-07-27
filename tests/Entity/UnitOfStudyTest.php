<?php

use PHPUnit\Framework\TestCase;

use Maherio\Lyceum\Entity\Domain;
use Maherio\Lyceum\Entity\GradeLevel;
use Maherio\Lyceum\Entity\UnitOfStudy;

class UnitOfStudyTest extends TestCase {
    protected $domain;
    protected $gradeLevel;

    protected function setUp() {
        $this->domain = new Domain('test');
        $this->gradeLevel = new GradeLevel('1');
    }

    public function testInstantiable() {
        $unit = new UnitOfStudy($this->domain, $this->gradeLevel);

        $this->assertInstanceOf(UnitOfStudy::class, $unit);
    }

    public function testGetsDomain() {
        $unit = new UnitOfStudy($this->domain, $this->gradeLevel);

        $this->assertEquals($this->domain, $unit->getDomain());
    }

    public function testGetsGradeLevel() {
        $unit = new UnitOfStudy($this->domain, $this->gradeLevel);

        $this->assertEquals($this->gradeLevel, $unit->getGradeLevel());
    }
}
