<?php

namespace App\Models;

class BlockchainNetwork
{
    const PHALA = 1;
    const ALEPH_ZERO = 2;

    public static function getBlockchainNetworks()
    {
        return [
            self::PHALA => 'Phala',
            self::ALEPH_ZERO => 'Aleph Zero',
        ];
    }
}
