<?php

namespace Maherio\Lyceum\Factory;

use Maherio\Lyceum\Entity\Domain;
use Maherio\Lyceum\Entity\GradeLevel;
use Maherio\Lyceum\Entity\UnitOfStudy;

class UnitOfStudyFactory {
    /**
     * Generates a new UnitOfStudy entity.
     * @param  Domain     $domain The domain this unit covers.
     * @param  GradeLevel $level  The grade level this unit is at.
     * @return UnitOfStudy        The newly created UnitOfStudy entity.
     */
    public function create(Domain $domain, GradeLevel $level) {
        return new UnitOfStudy($domain, $level);
    }
}
