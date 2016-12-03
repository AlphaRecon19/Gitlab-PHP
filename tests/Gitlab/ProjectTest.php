<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */
namespace Gitlab\Tests;

use Gitlab\Project;

class ProjectTest extends BaseUnit
{
    private function checkNewRepo($test, $name, $config = false)
    {
        $this->assertTrue(is_array($test), "Gitlab didn't return an array");
        $this->assertSame($name, $test['name'], "Name of new project doesn't match");

        if (is_array($config)) {
            foreach ($config as $key => $value) {
                if ($key === 'namespace_id') {
                    $this->assertSame($value, $test['namespace']['id']);
                } elseif (is_bool($test[$key])) {
                    $this->assertSame(boolval($value), $test[$key]);
                } else {
                    $this->assertSame($value, $test[$key]);
                }
            }
        }

    }

    public function testCreateProject()
    {
        $gitlab = $this->getGitlab();
        $project = new Project($gitlab);

        $name = md5(time());
        $test = $project->create($name);
        $this->checkNewRepo($test, $name);
    }

    public function testCreateWithOptionsProject()
    {
        $gitlab = $this->getGitlab();
        $project = new Project($gitlab);

        $name = md5(time());
        $config = [
            'namespace_id' => 1,
            'description' => md5(time()),
            'issues_enabled' => 0,
            'merge_requests_enabled' => 0,
            'builds_enabled' => 0,
            'wiki_enabled' => 0,
            'snippets_enabled' => 0,
            'shared_runners_enabled' => 0,
            'visibility_level' => 0
        ];
        $test = $project->create($name, $config);
        $this->checkNewRepo($test, $name, $config);

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