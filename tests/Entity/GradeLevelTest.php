<?php

use PHPUnit\Framework\TestCase;

use Maherio\Lyceum\Entity\GradeLevel;

class GradeLevelTest extends TestCase {
    public function testInstantiable() {
        $gradeLevel = new GradeLevel('1');

        $this->assertInstanceOf(GradeLevel::class, $gradeLevel);
    }

    public function testGetsLevel() {
        $levelText = '1';
        $gradeLevel = new GradeLevel($levelText);

        $this->assertEquals($levelText, '' . $gradeLevel); //testing __toString
    }

    public function testGreaterThan() {
        $firstLevel = 'K';
        $secondLevel = '1';
        $thirdLevel = '5';

        $firstGradeLevel = new GradeLevel($firstLevel);
        $secondGradeLevel = new GradeLevel($secondLevel);
        $thirdGradeLevel = new GradeLevel($thirdLevel);

        $this->assertTrue($secondGradeLevel->isGreaterThanOrEqualTo($firstGradeLevel));
        $this->assertTrue($thirdGradeLevel->isGreaterThanOrEqualTo($firstGradeLevel));
        $this->assertTrue($thirdGradeLevel->isGreaterThanOrEqualTo($secondGradeLevel));

        $this->assertFalse($firstGradeLevel->isGreaterThanOrEqualTo($secondGradeLevel));
        $this->assertFalse($firstGradeLevel->isGreaterThanOrEqualTo($thirdGradeLevel));
        $this->assertFalse($secondGradeLevel->isGreaterThanOrEqualTo($thirdGradeLevel));

        $this->assertTrue($firstGradeLevel->isGreaterThanOrEqualTo($firstGradeLevel));
    }
}
