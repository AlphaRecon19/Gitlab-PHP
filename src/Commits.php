<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

class Commits extends Base
{
    protected $project;

    public function fetch($id)
    {
        $url = '/api/v3/projects/'. $id .'/repository/commits';

        return $this->get($url);;
    }
}
