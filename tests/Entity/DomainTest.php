<?php

use PHPUnit\Framework\TestCase;

use Maherio\Lyceum\Entity\Domain;

class DomainTest extends TestCase {
    public function testInstantiable() {
        $domain = new Domain('test');

        $this->assertInstanceOf(Domain::class, $domain);
    }

    public function testGetsDomain() {
        $domainText = 'test';
        $domain = new Domain($domainText);

        $this->assertEquals($domainText, $domain->getDomain());
        $this->assertEquals($domainText, '' . $domain); //testing __toString
    }
}
