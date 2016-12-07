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

        $gitlab = $this->getGitlab();
        $project = new Project($gitlab);
        $data = $project->fetch($test['id']);

        $this->assertSame($test['id'], $data['id']);
        $this->assertSame($test['description'], $data['description']);

        $this->assertSame($test['ssh_url_to_repo'], $data['ssh_url_to_repo']);
        $this->assertSame($test['http_url_to_repo'], $data['http_url_to_repo']);
        $this->assertSame($test['web_url'], $data['web_url']);

        $this->assertSame($test['issues_enabled'], $data['issues_enabled']);
        $this->assertSame($test['merge_requests_enabled'], $data['merge_requests_enabled']);
        $this->assertSame($test['builds_enabled'], $data['builds_enabled']);
        $this->assertSame($test['wiki_enabled'], $data['wiki_enabled']);
        $this->assertSame($test['snippets_enabled'], $data['snippets_enabled']);
        $this->assertSame($test['shared_runners_enabled'], $data['shared_runners_enabled']);
        $this->assertSame($test['visibility_level'], $data['visibility_level']);
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
