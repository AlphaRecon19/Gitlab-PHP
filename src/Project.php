<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

class Project extends Base
{
    public function create($name)
    {
        return $this->post('/api/v3/projects/?name=' . $name);
    }

    public function purge($id)
    {
        return $this->delete('/api/v3/projects/' . $id);
    }

    public function fetchAll()
    {
        return $this->get('/api/v3/projects');
    }

    public function fetchFile($projectId, $filePath, $branch = 'master')
    {
        $file = $this->get('/api/v3/projects/' . $projectId . '/repository/files?file_path=' . $filePath . '&ref=' . $branch);
        if ($file['encoding'] === 'base64') {
            $file['raw'] = base64_decode($file['content'], true);
        }

        return $file;
    }

    public function fetchArchive($namespace, $name, $path, $branch = 'master')
    {
        $file = $this->save("/$namespace/$name/repository/archive.tar.gz?ref=$branch", $path);

        return true;
    }
}