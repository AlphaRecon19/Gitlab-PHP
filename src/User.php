<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

class User extends Base
{
    public function create($email, $username, $name, $password, $config = [])
    {
        $url = '/api/v3/users/?email=' . $email;

        $config['username'] = $username;
        $config['name'] = $name;
        $config['password'] = $password;

        foreach ($config as $key => $value) {
            $url .= '&' . $key . '=' . $value;
        }

        return $this->post($url);
    }

    public function fetch($id)
    {
        $url = '/api/v3/users/' . $id;
        return $this->get($url);
    }

    public function fetchAll()
    {
        $url = '/api/v3/users';
        return $this->get($url);
    }

    public function fetchAllKeysForUser($id)
    {
        $url = '/api/v3/users/'. $id .'/keys';
        return $this->get($url);
    }
}
