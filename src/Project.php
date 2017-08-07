<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

class Project extends Base
{
    public function create($name, $config = [])
    {
        $url = '/api/v3/projects/?name=' . urlencode($name);
        $url = $this->buildUrl($url, $config);

        return $this->post($url);
    }

    public function purge($id)
    {
        return $this->delete('/api/v3/projects/' . $id);
    }

    public function fetch($id)
    {
        return $this->get('/api/v3/projects/' . $id);
    }

    public function fetchAll($limit = 100)
    {
        return $this->get('/api/v3/projects/?per_page=' . $limit);
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

    public function fetchAvatar($id, $path)
    {
        $data = $this->fetch($id);

        if ($data['avatar_url'] === null) {
            return false;
        }

        $this->save($data['avatar_url'], $path);

        return true;
    }

    /**
     * @link https://docs.gitlab.com/ce/api/projects.html#search-for-projects-by-name
     */
    public function search($query)
    {
        return $this->get('/api/v3/projects/search/' . $query);
    }

    public function addUserToRepo($id, $userId, $accessLevel = 30)
    {
        return $this->post('/api/v4/projects/'.$id.'/members', [
            'user_id' => $userId,
            'access_level' => $accessLevel
        ]);
    }

    public function unprotectBranch($id, $branch)
    {
        return $this->put('/api/v4/projects/'. $id .'/repository/branches/'. $branch .'/unprotect');
    }
}
