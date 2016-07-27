<?php

namespace Maherio\Lyceum\Factory;


use Maherio\Lyceum\Entity\LearningPath;
use Maherio\Lyceum\Entity\Student;
use Maherio\Lyceum\Factory\GradeFactory;
use Maherio\Lyceum\Factory\StudentFactory;

class LearningPathFactory {
    /**
     * Creates an instance of LearningPathFactory capable of generating one or more custom LearningPath entities.
     * @param StudentFactory $studentFactory A factory capable of generating one or more Student entities.
     * @param GradeFactory   $gradeFactory   A factory capable of generating one or more Grade entities.
     */
    public function __construct(StudentFactory $studentFactory, GradeFactory $gradeFactory) {
        $this->studentFactory = $studentFactory;
        $this->gradeFactory = $gradeFactory;
    }

    /**
     * Generates a new LearningPath entity.
     * @param  Student $student The student this learning path is for.
     * @param  array   $grades  The grades the student has to work through.
     * @return LearningPath     The newly created learning path.
     */
    public function create(Student $student, array $grades) {
        return new LearningPath($student, $grades);
    }

    /**
     * Generates an array of LearningPath entities, customized for each student.
     * @param  array  $studentsWithScores An array of student scores, where the first element is an array of domains and every subsequent element is an array in the form of [student name, grade levels this student tested at for each domain as identified by the first row].
     * @param  array  $gradesWithDomains  An array of grades and domains. Each element of the array must be another array with grade level first, followed by the domains for that grade.
     * @return array                      An array of LearningPath entities.
     */
    public function bulkCreate(array $studentsWithScores, array $gradesWithDomains) {
        //first generate Students
        $students = $this->studentFactory->bulkCreate($studentsWithScores);

        //then generate Grades
        $grades = $this->gradeFactory->bulkCreate($gradesWithDomains);

        //lastly generate the LearningPaths
        $studentLearningPaths = [];
        foreach ($students as $student) {
            $studentLearningPaths[] = $this->create($student, $grades);
        }

        return $studentLearningPaths;
    }
}
