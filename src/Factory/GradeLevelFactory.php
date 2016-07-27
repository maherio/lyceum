<?php

namespace Maherio\Lyceum\Factory;

use Maherio\Lyceum\Entity\GradeLevel;

class GradeLevelFactory {
    /**
     * Generates a new GradeLevel entity
     * @param  string    $level  The grade level
     * @return GradeLevel        The newly created GradeLevel entity
     */
    public function create(string $level) {
        return new GradeLevel($level);
    }
}
