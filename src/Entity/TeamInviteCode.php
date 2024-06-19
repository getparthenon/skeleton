<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table("team_invite_codes")]
class TeamInviteCode extends \Parthenon\User\Entity\TeamInviteCode
{
}
