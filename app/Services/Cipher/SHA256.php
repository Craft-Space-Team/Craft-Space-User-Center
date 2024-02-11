<?php

namespace App\Services\Cipher;

class SHA256 extends BaseCipher
{
    public function hash($value, $salt = ''): string
    {
        $salt = (strlen($salt) == 32) ? $salt : $this->generateSalt();

        return '$SHA$'.$salt.'$'.hash('sha256', hash('sha256', $value).$salt);
    }
    protected function generateSalt()
    {
        return bin2hex(random_bytes(16));
    }
}
