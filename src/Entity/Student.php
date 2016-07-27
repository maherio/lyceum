<?php

namespace Maherio\Lyceum\Entity;

class Student {
    protected $name;
    protected $testScores;

    /**
     * Creates a new Student entity
     * @param string $name       The name of the student
     * @param array  $testScores An array of UnitOfStudy entities indicating the unit a student tested into
     */
    public function __construct(string $name, array $testScores) {
        $this->name = $name;
        $this->testScores = $testScores;
    }

    /**
     * Gets this student's current grade level at a given domain
     * @param  Domain $domain The domain to check for
     * @return GradeLevel     The grade level this student is currently at. False if they have not passed any grade levels yet.
     */
    public function getGradeLevel(Domain $domain) {
        foreach ($this->testScores as $unitOfStudy) {
            if($unitOfStudy->getDomain() == $domain->getDomain()) {
                return $unitOfStudy->getGradeLevel();
            }
        }

        return false;
    }

    /**
     * Get the student's name
     * @return string The student name
     */
    public function getName() {
        return $this->name;
    }
}
