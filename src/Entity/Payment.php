<?php

declare(strict_types=1);

/*
 * Copyright 2024 all rights reserved. No public license.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('payment')]
class Payment extends \Parthenon\Billing\Entity\Payment
{
}
