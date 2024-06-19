<?php

/*
 * Copyright 2024 all rights reserved
 */

namespace App\Repository;

use App\Entity\User;
use Parthenon\Billing\Entity\CustomerInterface;
use Parthenon\Payments\SubscriptionInterface;
use Parthenon\User\Entity\UserInterface;

class TeamRepository extends \Parthenon\User\Repository\TeamRepository implements TeamRepositoryInterface
{
    /**
     * @param User $user
     */
    public function getSubscriptionForUser(UserInterface $user): SubscriptionInterface
    {
        return $user->getTeam()->getSubscription();
    }

    public function findAllSubscriptions(): array
    {
        return $this->entityRepository->createQueryBuilder('t')
            ->where('t.subscription.paymentId is not null')
            ->getQuery()
            ->getResult();
    }

    public function getByExternalReference(string $externalReference): CustomerInterface
    {
        return $this->entityRepository->findOneBy(['externalReference' => $externalReference]);
    }
}
