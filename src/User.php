<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

use violuke\RsaSshKeyFingerprint\FingerprintGenerator;

class User extends Base
{
    public function create($email, $username, $name, $password, $config = [])
    {
        $url = '/api/v3/users/?email=' . $email;

        $config['username'] = $username;
        $config['name'] = $name;
        $config['password'] = $password;

        $url = $this->buildUrl($url, $config);

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
        $keys = $this->get($url);

        if (!is_array($keys)) {
            return false;
        }

        foreach ($keys as $key => $value) {
            $keys[$key]['fingerprint'] = FingerprintGenerator::getFingerprint($value['key']);
        }

        return $keys;
    }

    public function addKeyToUser($id, $key, $title)
    {
        $url = '/api/v3/users/'. $id .'/keys';

        return $this->post($url, [
            'title' => $title,
            'key' => $key
        ]);
    }
}
