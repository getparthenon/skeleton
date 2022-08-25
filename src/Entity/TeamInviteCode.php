<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Parthenon\Subscriptions\Plan\LimitableInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="team_invite_codes")
 */
class TeamInviteCode extends \Parthenon\User\Entity\TeamInviteCode implements LimitableInterface
{
}
