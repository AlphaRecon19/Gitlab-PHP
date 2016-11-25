<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */
namespace Gitlab\Tests;

use Gitlab\Project;

class ProjectTest extends BaseUnit
{
    public function testCreateProject()
    {
        $gitlab = $this->getGitlab();
        $project = new Project($gitlab);

        $name = md5(time());
        $test = $project->create($name);
    }

    public function testFetchAll()
    {
        $gitlab = $this->getGitlab();
        $project = new Project($gitlab);

        $test = $project->fetchAll();
        $this->assertGreaterThanOrEqual(1, $test, "No projects found");
    }

    public function testRemoveAllPorjects()
    {
        $gitlab = $this->getGitlab();
        $project = new Project($gitlab);

        foreach ($project->fetchAll() as $key => $value) {
            $test = $project->purge($value["id"]);
            $this->assertTrue($test, "Unable to remove ");
        }
    }
}