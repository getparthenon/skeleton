<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Parthenon\Billing\Plan\LimitableInterface;

#[ORM\Entity]
#[ORM\Table('team_invite_codes')]
class TeamInviteCode extends \Parthenon\User\Entity\TeamInviteCode implements LimitableInterface
{
    public function getLimitableName(): string
    {
        return 'team_invite';
    }
}
