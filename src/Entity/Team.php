<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Parthenon\Billing\Entity\CustomerInterface;
use Parthenon\Billing\Entity\EmbeddedSubscription;
use Parthenon\Common\Address;

#[ORM\Entity]
#[ORM\Table('teams')]
class Team extends \Parthenon\User\Entity\Team implements CustomerInterface
{
    #[ORM\OneToMany(mappedBy: 'team', targetEntity: User::class)]
    protected Collection $members;

    #[ORM\Embedded(class: Address::class)]
    protected Address $billingAddress;

    #[ORM\Column(name: 'external_customer_reference', nullable: true)]
    protected ?string $externalCustomerReference;

    #[ORM\Column(name: 'payment_provider_details_url', nullable: true)]
    protected ?string $paymentProviderDetailsUrl;

    #[ORM\Embedded(class: EmbeddedSubscription::class)]
    private ?EmbeddedSubscription $subscription;

    public function getMembers(): array
    {
        return $this->members->toArray();
    }

    public function setMembers(Collection $members): void
    {
        $this->members = $members;
    }

    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(Address $address): void
    {
        $this->billingAddress = $address;
    }

    public function getExternalCustomerReference(): ?string
    {
        return $this->externalCustomerReference;
    }

    public function setExternalCustomerReference($externalCustomerReference): void
    {
        $this->externalCustomerReference = $externalCustomerReference;
    }

    public function getPaymentProviderDetailsUrl(): ?string
    {
        return $this->paymentProviderDetailsUrl;
    }

    public function setPaymentProviderDetailsUrl($paymentProviderDetailsUrl): void
    {
        $this->paymentProviderDetailsUrl = $paymentProviderDetailsUrl;
    }

    public function getSubscription(): ?EmbeddedSubscription
    {
        return $this->subscription;
    }

    public function setSubscription(?EmbeddedSubscription $subscription): void
    {
        $this->subscription = $subscription;
    }

    public function getDisplayName(): string
    {
        return $this->getBillingEmail();
    }

    public function hasBillingAddress(): bool
    {
        return isset($this->billingAddress);
    }

    public function hasExternalCustomerReference(): bool
    {
        return isset($this->externalCustomerReference);
    }
}
