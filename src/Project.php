<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

class Project extends Base
{
    public function fetchAllProjects()
    {
        return $this->get('/api/v3/projects');
    }

    public function fetchProjectFile($projectId, $filePath, $branch = 'master')
    {
        $file = $this->get('/api/v3/projects/' . $projectId . '/repository/files?file_path=' . $filePath . '&ref=' . $branch);
        if ($file['encoding'] === 'base64') {
            $file['raw'] = base64_decode($file['content'], true);
        }

        return $file;
    }
}