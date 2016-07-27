<?php

namespace Maherio\Lyceum\Factory;

use Maherio\Lyceum\Entity\Student;
use Maherio\Lyceum\Factory\DomainFactory;
use Maherio\Lyceum\Factory\GradeLevelFactory;
use Maherio\Lyceum\Factory\UnitOfStudyFactory;

class StudentFactory {
    /**
     * Creates a new Student Factory capable of generating new Student entities
     * @param DomainFactory      $domainFactory      A factory capable of generating new Domain entities
     * @param GradeLevelFactory  $gradeLevelFactory  A factory capable of generating new GradeLevel entities
     * @param UnitOfStudyFactory $unitOfStudyFactory A factory capable of generating new UnitOfStudy entities
     */
    public function __construct(DomainFactory $domainFactory, GradeLevelFactory $gradeLevelFactory, UnitOfStudyFactory $unitOfStudyFactory) {
        $this->domainFactory = $domainFactory;
        $this->gradeLevelFactory = $gradeLevelFactory;
        $this->unitOfStudyFactory = $unitOfStudyFactory;
    }

    /**
     * Generates a new Student entity.
     * @param  string $name       The name of the student.
     * @param  array  $testScores An array of UnitOfStudy entites indicating what level a student tested into for a domain.
     * @return Student            The newly created Student entity.
     */
    public function create(string $name, array $testScores) {
        return new Student($name, $testScores);
    }

    /**
     * Generates an array of Student entities given an array of test scores in given domains
     * @param  array  $studentsWithScores An array of student scores, where the first element is an array of domains and every subsequent element is an array in the form of [student name, grade levels this student tested at for each domain as identified by the first row].
     * @return array                      An array of newly created Student entities
     */
    public function bulkCreate(array $studentsWithScores) {
        //first element is the domain key
        $domainValues = array_shift($studentsWithScores);

        $students = [];
        foreach ($studentsWithScores as $studentValues) {
            $studentName = $studentValues[0];
            $testScores = [];

            //start at index 1 b/c we already got the name
            for ($index = 1; $index < count($studentValues); ++$index) {
                $domain = $this->domainFactory->create($domainValues[$index]);
                $gradeLevel = $this->gradeLevelFactory->create($studentValues[$index]);
                $testScores[$domain->getDomain()] = $this->unitOfStudyFactory->create($domain, $gradeLevel);
            }

            $students[] = $this->create($studentName, $testScores);
        }

        return $students;
    }
}
