<?php

namespace App\Services\Cipher;

abstract class BaseCipher
{
    /**
     * Encrypt given string with given salt.
     *
     * @param string $value
     * @param string $salt
     */
    abstract public function hash($value, $salt = '');

    /**
     * Verify that the given hash matches the given password.
     *
     * @param string $password
     * @param string $hash
     * @param string $salt
     */
    public function verify($password, $hash, $salt = '')
    {
        $salt = $this->parseHash($hash)['salt'];

        return hash_equals($hash, $this->hash($password, $salt));
    }
    
    protected function parseHash($hash)
    {
        $parts = explode('$', $hash);

        return [
            'hash' => $parts[3],
            'salt' => $parts[2],
        ];
    }
}
