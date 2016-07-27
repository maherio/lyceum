<?php

namespace Maherio\Lyceum\Entity;

use Maherio\Lyceum\Entity\Domain;
use Maherio\Lyceum\Entity\GradeLevel;

class UnitOfStudy {
    public function __construct(Domain $domain, GradeLevel $gradeLevel) {
        $this->domain = $domain;
        $this->gradeLevel = $gradeLevel;
    }

    public function getGradeLevel() {
        return $this->gradeLevel;
    }

    public function getDomain() {
        return $this->domain;
    }
}
