<?php

use PHPUnit\Framework\TestCase;

use Maherio\Lyceum\Entity\Domain;
use Maherio\Lyceum\Entity\Grade;
use Maherio\Lyceum\Entity\GradeLevel;

class GradeTest extends TestCase {
    protected $gradeLevel;
    protected $domains;

    protected function setUp() {
        $this->gradeLevel = new GradeLevel('1');
        $this->domains = [
            new Domain('test'),
            new Domain('1')
        ];
    }

    public function testInstantiable() {
        $grade = new Grade($this->gradeLevel, $this->domains);

        $this->assertInstanceOf(Grade::class, $grade);
    }

    public function testGetsGradeLevel() {
        $grade = new Grade($this->gradeLevel, $this->domains);

        $this->assertEquals($this->gradeLevel, $grade->getGradeLevel());
    }

    public function testGetsDomains() {
        $grade = new Grade($this->gradeLevel, $this->domains);

        $this->assertEquals($this->domains, $grade->getDomains());
    }
}
