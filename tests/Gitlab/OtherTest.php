<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */
namespace Gitlab\Tests;

use Gitlab\Other;

class OtherTest extends BaseUnit
{
    public function testFetchVersion()
    {
        $gitlab = $this->getGitlab();
        $other = new Other($gitlab);
        $version = $other->fetchVersion();
        
        $this->assertNotNull($version, "Unable to get version");
        $this->assertNotNull($version['version'], "Unable to get version");
        $this->assertNotNull($version['revision'], "Unable to get revision");
    }
}