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

        $this->assertTrue($secondGradeLevel->isGreaterThan($firstGradeLevel));
        $this->assertTrue($thirdGradeLevel->isGreaterThan($firstGradeLevel));
        $this->assertTrue($thirdGradeLevel->isGreaterThan($secondGradeLevel));

        $this->assertFalse($firstGradeLevel->isGreaterThan($secondGradeLevel));
        $this->assertFalse($firstGradeLevel->isGreaterThan($thirdGradeLevel));
        $this->assertFalse($secondGradeLevel->isGreaterThan($thirdGradeLevel));

        $this->assertFalse($firstGradeLevel->isGreaterThan($firstGradeLevel));
    }
}
