<?php

namespace App\Constants;

class Role
{
    public const ADMIN = 'ADMIN';
    public const PEGAWAI = 'PEGAWAI';
    public const ATASAN = 'ATASAN';

    public static function all(): array
    {
        return [
            self::ADMIN,
            self::PEGAWAI,
            self::ATASAN,
        ];
    }
}