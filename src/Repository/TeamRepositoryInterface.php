<?php

namespace App\Repository;

use Parthenon\Subscriptions\Repository\SubscriberRepositoryInterface;

interface TeamRepositoryInterface extends \Parthenon\User\Repository\TeamRepositoryInterface, SubscriberRepositoryInterface
{
}
