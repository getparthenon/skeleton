<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('forgot_password_code')]
class ForgotPasswordCode extends \Parthenon\User\Entity\ForgotPasswordCode
{
}
