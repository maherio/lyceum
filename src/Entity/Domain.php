<?php

namespace Maherio\Lyceum\Entity;

class Domain {
    protected $domain;

    public function __construct(string $domain) {
        $this->domain = $domain;
    }

    /**
     * Returns the educational domain as a string
     * @return string The domain
     */
    public function getDomain() {
        return $this->domain;
    }

    public function __toString() {
        return $this->getDomain();
    }
}
