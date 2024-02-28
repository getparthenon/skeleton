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

use Behat\Behat\Context\Context;
use Behat\Mink\Session;
use Parthenon\Billing\Plan\PlanManager;

class PlanContext implements Context
{
    use SendRequestTrait;

    public function __construct(private Session $session, private PlanManager $planManager)
    {
    }

    /**
     * @When I view the plans
     */
    public function iViewThePlans()
    {
        $this->sendJsonRequest('GET', '/api/billing/plans');
    }

    /**
     * @Then I should see the plans that are configured
     */
    public function iShouldSeeThePlansThatAreConfigured()
    {
        $content = $this->getJsonContent();

        $plans = $this->planManager->getPlans();

        foreach ($plans as $plan) {
            $name = $plan->getName();
            if (!isset($content['plans'][$name])) {
                throw new \Exception("Can't see plan ".$name);
            }

            if ($content['plans'][$name]['limits'] != $plan->getLimits()) {
                throw new \Exception('Plan for '.$plan->getLimits());
            }
        }
    }
}
