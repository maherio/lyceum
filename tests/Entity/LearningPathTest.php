<?php

use PHPUnit\Framework\TestCase;

use Maherio\Lyceum\Entity\Domain;
use Maherio\Lyceum\Entity\Grade;
use Maherio\Lyceum\Entity\GradeLevel;
use Maherio\Lyceum\Entity\LearningPath;
use Maherio\Lyceum\Entity\Student;
use Maherio\Lyceum\Entity\UnitOfStudy;

class LearningPathTest extends TestCase {
    protected $domains;
    protected $levels;
    protected $testScores;

    protected function setUp() {
        $this->student = $this->setUpStudent();
        $this->grades = $this->setUpGrades();
    }

    protected function setUpStudent() {
        $this->scoresArray = [
            'test' => '1',
            'RI' => '3',
        ];

        $testScores = [];
        foreach ($this->scoresArray as $scoreDomain => $scoreLevel) {
            $domain = new Domain($scoreDomain);
            $level = new GradeLevel($scoreLevel);
            $testScores[] = new UnitOfStudy($domain, $level);
        }

        $this->studentName = 'Sterling Archer';
        return new Student($this->studentName, $testScores);
    }

    protected function setUpGrades() {
        $this->gradesArray = [
            'K' => ['test', 'RI', 'P'],
            '1' => ['test', 'P'],
            '2' => ['test', 'RI', 'P'],
            '3' => ['RI'],
        ];

        $grades = [];
        foreach ($this->gradesArray as $level => $domains) {
            $gradeLevel = new GradeLevel($level);
            $gradeDomains = [];
            foreach ($domains as $domain) {
                $gradeDomains[] = new Domain($domain);
            }

            $grades[] = new Grade($gradeLevel, $gradeDomains);
        }

        return $grades;
    }

    protected function getExpectedPath() {
        $path = [
            $this->studentName
        ];
        foreach ($this->gradesArray as $level => $domains) {
            foreach ($domains as $domain) {
                if(array_key_exists($domain, $this->scoresArray)) {
                    //user has a score for this domain, check the level
                    if($level == 'K') {
                        if($this->scoresArray[$domain] == 'K') {
                            $path[] = $level . '.' . $domain;
                        }
                    } else if($level >= $this->scoresArray[$domain]) {
                        $path[] = $level . '.' . $domain;
                    }
                } else {
                    //user has no score
                    $path[] = $level . '.' . $domain;
                }
            }
        }
        return $path;
    }

    public function testInstantiable() {
        $learningPath = new LearningPath($this->student, $this->grades);

        $this->assertInstanceOf(LearningPath::class, $learningPath);
    }

    public function testToArray() {
        $learningPath = new LearningPath($this->student, $this->grades);

        $this->assertEquals($this->getExpectedPath(), $learningPath->toArray());
    }
}
