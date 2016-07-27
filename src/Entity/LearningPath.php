<?php

namespace Maherio\Lyceum\Entity;

use Maherio\Lyceum\Entity\Domain;

class LearningPath {
    protected $student;
    protected $grades;

    /**
     * Creates a new LearningPath for a student to work on.
     * @param Student $student    The Student this LearningPath is being created for
     * @param array   $grades     The Grades a student must work through.
     */
    public function __construct(Student $student, array $grades) {
        $this->student = $student;
        $this->grades = $grades;
    }

    /**
     * Returns the learning path as an array.
     * @param int $limit The maximum amount of units of study to return
     * @return array     This learning path in array format.
     */
    public function toArray(int $limit = null) {
        $learningPath = [
            $this->student->getName()
        ];

        foreach ($this->grades as $grade) {
            foreach ($grade->getDomains() as $domain) {
                $studentGradeLevel = $this->student->getGradeLevel($domain);

                //if the student has no grade level for this domain, or if this grade is above the student's level, add it
                if(!$studentGradeLevel || $grade->getGradeLevel()->isGreaterThanOrEqualTo($studentGradeLevel)) {
                    $learningPath[] = $grade->getGradeLevel() . '.' . $domain;
                }

                //if we've reached the limit (limit does not include student name), just return
                if($limit && count($learningPath) >= $limit + 1) {
                    return $learningPath;
                }
            }
        }

        return $learningPath;
    }
}
