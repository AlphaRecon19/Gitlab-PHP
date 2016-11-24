<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

class Other extends Base
{
    public function fetchVersion()
    {
        return $this->get('/api/v3/version');
    }
}