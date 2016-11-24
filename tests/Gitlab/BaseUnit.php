<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */
namespace Gitlab\Tests;

use Gitlab;

abstract class BaseUnit extends \PHPUnit_Framework_TestCase
{
    protected $gitlab;

    public function getGitlab()
    {
        return $this->gitlab;
    }

    protected function setup()
    {
        $this->newGitlab();
    }

    protected function newGitlab()
    {
        $url = "http://localhost:9980";
        $token = getenv('GitlabToken');

        $this->gitlab = new Gitlab\Gitlab($url, $token);
        return $this->getGitlab();
    }
}