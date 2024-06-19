<?php

declare(strict_types=1);

/*
 * Copyright (C) 2020-2024 Iain Cambridge
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace App\Billing;

use App\Entity\Price;
use App\Entity\Product;
use App\Entity\Receipt;
use App\Entity\ReceiptLine;
use App\Entity\SubscriptionPlan;
use Parthenon\Billing\Entity\ChargeBack;
use Parthenon\Billing\Entity\Payment;
use Parthenon\Billing\Entity\PriceInterface;
use Parthenon\Billing\Entity\ProductInterface;
use Parthenon\Billing\Entity\ReceiptInterface;
use Parthenon\Billing\Entity\ReceiptLineInterface;
use Parthenon\Billing\Entity\Subscription;
use Parthenon\Billing\Entity\SubscriptionPlanInterface;
use Parthenon\Billing\Factory\EntityFactoryInterface;

class EntityFactory implements EntityFactoryInterface
{
    public function getProductEntity(): ProductInterface
    {
        return new Product();
    }

    public function getPriceEntity(): PriceInterface
    {
        return new Price();
    }

    public function getSubscriptionPlanEntity(): SubscriptionPlanInterface
    {
        return new SubscriptionPlan();
    }

    public function getSubscriptionEntity(): Subscription
    {
        return new \App\Entity\Subscription();
    }

    public function getPaymentEntity(): Payment
    {
        return new \App\Entity\Payment();
    }

    public function getChargeBackEntity(): ChargeBack
    {
        return new ChargeBack();
    }

    public function getReceipt(): ReceiptInterface
    {
        return new Receipt();
    }

    public function getReceiptLine(): ReceiptLineInterface
    {
        return new ReceiptLine();
    }
}
