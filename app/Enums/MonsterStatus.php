<?php

namespace App\Enums;

enum MonsterStatus: string
{
    case WORKING = 'working';
    case NOTWORKING = 'not-working';
    case DONTKNOW = 'dont-know';

    public function getReadableStatus()
    {
        return match ($this) {
            MonsterStatus::WORKING    => 'Is working',
            MonsterStatus::NOTWORKING => 'Is not working',
            MonsterStatus::DONTKNOW   => 'We didn\'t know',
        };
    }
}
