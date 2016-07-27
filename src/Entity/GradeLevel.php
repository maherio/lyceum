<?php

namespace Maherio\Lyceum\Entity;

class GradeLevel {
    protected $level;

    /**
     * Creates a new GradeLevel entity
     * @param string $level The current grade level
     */
    public function __construct(string $level) {
        $this->level = $level;
    }

    /**
     * Returns a string representation of this grade level
     * @return string [description]
     */
    public function __toString() {
        return $this->level;
    }

    /**
     * Is-greater-than comparison operator for two GradeLevel entities.
     * @param  GradeLevel $gradeLevel The GradeLevel to compare against.
     * @return boolean                True if this Gradelevel is greater than (i.e. comes after) the one passed in.
     */
    public function isGreaterThanOrEqualTo(GradeLevel $gradeLevel) {
        //hmm hardcoding 'K' for now, but this should be dynamic depending on the domain_order input
        if($this->level == $gradeLevel || $gradeLevel == 'K') {
            return true;
        } else if($this->level == 'K') {
            return false;
        }

        return $this->level >= $gradeLevel;
    }
}
