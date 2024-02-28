<?php

declare(strict_types=1);

/*
 * Copyright Humbly Arrogant Software Limited 2020-2024
 *
 * Use of this software is governed by the Business Source License included in the LICENSE file and at https://getparthenon.com/docs/next/license.
 *
 * Change Date: 26.06.2026 ( 3 years after 2.2.0 release )
 *
 * On the date above, in accordance with the Business Source License, use of this software will be governed by the open source license specified in the LICENSE file.
 */

namespace App\Tests\Behat\Skeleton;

use App\Repository\Orm\TeamInviteCodeRepository;
use App\Repository\Orm\TeamRepository;
use Behat\Behat\Context\Context;
use Behat\Mink\Session;
use Parthenon\User\Entity\InviteCode;

class TeamContext implements Context
{
    use SendRequestTrait;
    use TeamTrait;

    public function __construct(
        private Session $session,
        private TeamRepository $teamRepository,
        private TeamInviteCodeRepository $inviteCodeRepository
    ) {
    }

    /**
     * @When I view the team view
     */
    public function iViewTheTeamView()
    {
        $this->sendJsonRequest('GET', '/api/user/team');
    }

    /**
     * @Then there should be an invite for :arg1 to :arg2
     */
    public function thereShouldBeAnInviteForTo($email, $teamName)
    {
        $team = $this->getTeamByName($teamName);
        $inviteCode = $this->inviteCodeRepository->findOneBy(['email' => $email, 'team' => $team]);

        if (!$inviteCode instanceof InviteCode) {
            throw new \Exception('No invite code');
        }
    }

    /**
     * @Then I should be told that the email has already been invited
     */
    public function iShouldBeToldThatTheEmailHasAlreadyBeenInvited()
    {
        $jsonData = json_decode($this->session->getPage()->getContent(), true);

        if (!$jsonData['already_invited']) {
            throw new \Exception('Not declared as already invited');
        }
    }

    /**
     * @When I cancel the invite for :arg1
     */
    public function iCancelTheInviteFor($email)
    {
        /** @var InviteCode $inviteCode */
        $inviteCode = $this->inviteCodeRepository->findOneBy(['email' => $email]);

        $this->sendJsonRequest('POST', '/api/user/team/invite/'.$inviteCode->getId().'/cancel');
    }

    /**
     * @Then I should see :arg1 as an invited user
     */
    public function iShouldSeeAsAnInvitedUser($email)
    {
        $jsonData = json_decode($this->session->getPage()->getContent(), true);
        foreach ($jsonData['sent_invites'] as $invite) {
            if ($invite['email'] == $email) {
                return;
            }
        }

        throw new \Exception('The user is not in the invited list');
    }

    /**
     * @Then I should see the member :arg1 in the member list
     */
    public function iShouldSeeTheMemberInTheMemberList($email)
    {
        $jsonData = json_decode($this->session->getPage()->getContent(), true);

        foreach ($jsonData['members'] as $invite) {
            if ($invite['email'] == $email) {
                return;
            }
        }

        throw new \Exception('Email not found');
    }

    /**
     * @Then the invite for :arg1 shouldn't be usable
     */
    public function theInviteForShouldntBeUsable($email)
    {
        /** @var InviteCode $inviteCode */
        $inviteCode = $this->inviteCodeRepository->findOneBy(['email' => $email]);
        $this->inviteCodeRepository->getEntityManager()->refresh($inviteCode);

        if (!$inviteCode->isUsed()) {
            throw new \Exception('Invite is usable');
        }
    }

    /**
     * @Then /^I should be told that the email is already a member$/
     */
    public function iShouldBeToldThatTheEmailIsAlreadyAMember()
    {
        $jsonData = json_decode($this->session->getPage()->getContent(), true);

        if (!$jsonData['already_a_member']) {
            throw new \Exception('Not declared as already a member');
        }
    }
}
