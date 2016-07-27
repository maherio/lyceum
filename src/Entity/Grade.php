<?php

namespace Maherio\Lyceum\Entity;

use Maherio\Lyceum\Entity\GradeLevel;
use Maherio\Lyceum\Entity\Domain;

class Grade {
    protected $gradeLevel;
    protected $domains;

    /**
     * Creates a Grade entity, which owns the order of domains to learn in a given grade
     * @param string $grade   A string representation of this grade
     * @param array  $domains An ordered array of Domain entities to study for this grade
     */
    public function __construct(GradeLevel $gradeLevel, array $domains) {
        $this->gradeLevel = $gradeLevel;
        $this->domains = $domains;
    }

    /**
     * Returns an ordered array of Domain entities for this grade level
     * @return array The Domain entities
     */
    public function getDomains() {
        return $this->domains;
    }

    /**
     * Returns this grade level
     * @return GradeLevel The level of this grade
     */
    public function getGradeLevel() {
        return $this->gradeLevel;
    }
}
