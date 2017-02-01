<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

class Commits extends Base
{
    public function create($id, $branch, $message, $email, $name, array $actions)
    {
        $url = "/api/v3/projects/$id/repository/commits";

        $data = [
            'branch_name' => $branch,
            'commit_message' => $message,
            'author_email' => $email,
            'author_name' => $name,
            "actions" => $actions
        ];

        return $this->post($url, $data);
    }

    public function fetch($id, $limit = 30)
    {
        $url = '/api/v3/projects/'. $id .'/repository/commits/?per_page=' . $limit;

        return $this->get($url);
    }

    public function fetchSingle($id, $sha)
    {
        $url = '/api/v3/projects/'. $id .'/repository/commits/' . $sha;

        return $this->get($url);
    }
}