<?php

namespace Maherio\Lyceum\Factory;

use Maherio\Lyceum\Factory\GradeLevelFactory;
use Maherio\Lyceum\Factory\DomainFactory;
use Maherio\Lyceum\Entity\GradeLevel;
use Maherio\Lyceum\Entity\Grade;

class GradeFactory {
    protected $gradeLevelFactory;
    protected $domainFactory;

    /**
     * Creates a new Grade factory capable of generating new Grade entities.
     * @param GradeLevelFactory $gradeLevelFactory A factory capable of generating new GradeLevel entities
     * @param DomainFactory     $domainFactory     A factory capable of generating new Domain entities
     */
    public function __construct(GradeLevelFactory $gradeLevelFactory, DomainFactory $domainFactory) {
        $this->gradeLevelFactory = $gradeLevelFactory;
        $this->domainFactory = $domainFactory;
    }

    /**
     * Generates a new Grade entity
     * @param  GradeLevel $gradeLevel The grade level
     * @param  array      $domains    An ordered array of Domain entities that belong in this grade
     * @return Grade                  A newly created Grade entity
     */
    public function create(GradeLevel $gradeLevel, array $domains) {
        return new Grade($gradeLevel, $domains);
    }

    /**
     * Given an array containing integer and string representations of multiple grades with domains, this generates an
     * array of Grade entities
     * @param  array  $gradesWithDomains An array of grades and domains. Each element of the array must be another array with grade level first, followed by the domains for that grade.
     * @return array                     An array of Grade entities
     */
    public function bulkCreate(array $gradesWithDomains) {
        //use the domain order to create an array of Grade entities
        $grades = [];
        foreach ($gradesWithDomains as $gradeDomains) {
            $level = array_shift($gradeDomains);
            $gradeLevel = $this->gradeLevelFactory->create($level);
            $domains = $this->domainFactory->bulkCreate($gradeDomains);
            $grades[] = $this->create($gradeLevel, $domains);
        }

        return $grades;
    }
}
