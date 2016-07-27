<?php

namespace Maherio\Lyceum\Factory;

use Maherio\Lyceum\Entity\Domain;

class DomainFactory {
    /**
     * Create a new Domain instance.
     * @param  string $domain The string representation of the domain.
     * @return Domain         The newly created Domain.
     */
    public function create(string $domain) {
        return new Domain($domain);
    }

    /**
     * Generates an array of Domain entities.
     * @param  array  $domains The array of string representations for domains.
     * @return array           The array of Domain entities.
     */
    public function bulkCreate(array $domains) {
        $myDomains = [];
        foreach ($domains as $domain) {
            $myDomains[] = $this->create($domain);
        }

        return $myDomains;
    }
}
