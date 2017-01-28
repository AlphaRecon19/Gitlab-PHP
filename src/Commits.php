<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

class Commits extends Base
{
    protected $project;

    public function fetch($id, $limit = 30)
    {
        $url = '/api/v3/projects/'. $id .'/repository/commits/?per_page=' . $limit;

        return $this->get($url);
    }

    public function fetchSingle($id, $sha)
    {
        $url = '/api/v3/projects/'. $id .'/repository/commits/' . $sha;

        return $this->get($url);;
    }
}