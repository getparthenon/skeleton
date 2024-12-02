<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241202092637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE charge_back (id UUID NOT NULL, payment_id UUID DEFAULT NULL, customer_id UUID DEFAULT NULL, external_reference VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, reason VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_250DACE84C3A3BB ON charge_back (payment_id)');
        $this->addSql('CREATE INDEX IDX_250DACE89395C3F3 ON charge_back (customer_id)');
        $this->addSql('COMMENT ON COLUMN charge_back.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN charge_back.payment_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN charge_back.customer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE forgot_password_code (id UUID NOT NULL, user_id UUID DEFAULT NULL, code VARCHAR(255) NOT NULL, used BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, used_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B30A7571A76ED395 ON forgot_password_code (user_id)');
        $this->addSql('COMMENT ON COLUMN forgot_password_code.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN forgot_password_code.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE invite_codes (id UUID NOT NULL, user_id UUID DEFAULT NULL, invited_user_id UUID DEFAULT NULL, code VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, used BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, used_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, cancelled BOOLEAN NOT NULL, role VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E8D89FB2A76ED395 ON invite_codes (user_id)');
        $this->addSql('CREATE INDEX IDX_E8D89FB2C58DAD6E ON invite_codes (invited_user_id)');
        $this->addSql('COMMENT ON COLUMN invite_codes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN invite_codes.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN invite_codes.invited_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE payment (id UUID NOT NULL, customer_id UUID DEFAULT NULL, provider VARCHAR(255) NOT NULL, payment_reference VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, amount INT NOT NULL, currency VARCHAR(255) NOT NULL, refunded BOOLEAN NOT NULL, completed BOOLEAN NOT NULL, charged_back BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, payment_provider_details_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D28840D9395C3F3 ON payment (customer_id)');
        $this->addSql('COMMENT ON COLUMN payment.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN payment.customer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE payment_subscription (payment_id UUID NOT NULL, subscription_id UUID NOT NULL, PRIMARY KEY(payment_id, subscription_id))');
        $this->addSql('CREATE INDEX IDX_C536D3C94C3A3BB ON payment_subscription (payment_id)');
        $this->addSql('CREATE INDEX IDX_C536D3C99A1887DC ON payment_subscription (subscription_id)');
        $this->addSql('COMMENT ON COLUMN payment_subscription.payment_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN payment_subscription.subscription_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE payment_card (id UUID NOT NULL, customer_id UUID DEFAULT NULL, provider VARCHAR(255) DEFAULT NULL, stored_customer_reference VARCHAR(255) DEFAULT NULL, stored_payment_reference VARCHAR(255) DEFAULT NULL, default_payment_option BOOLEAN NOT NULL, brand VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, last_four VARCHAR(255) DEFAULT NULL, expiry_month VARCHAR(255) DEFAULT NULL, expiry_year VARCHAR(255) DEFAULT NULL, is_deleted BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_37970FA79395C3F3 ON payment_card (customer_id)');
        $this->addSql('COMMENT ON COLUMN payment_card.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN payment_card.customer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE price (id UUID NOT NULL, product_id UUID DEFAULT NULL, amount INT DEFAULT NULL, currency VARCHAR(255) NOT NULL, recurring BOOLEAN DEFAULT NULL, usage BOOLEAN DEFAULT NULL, units INT DEFAULT NULL, public BOOLEAN DEFAULT NULL, type VARCHAR(255) NOT NULL, including_tax BOOLEAN DEFAULT NULL, is_deleted BOOLEAN DEFAULT NULL, schedule VARCHAR(255) DEFAULT NULL, external_reference VARCHAR(255) DEFAULT NULL, payment_provider_details_url VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CAC822D94584665A ON price (product_id)');
        $this->addSql('COMMENT ON COLUMN price.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN price.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE product (id UUID NOT NULL, name VARCHAR(255) NOT NULL, payment_provider_details_url VARCHAR(255) DEFAULT NULL, external_reference VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE receipt (id UUID NOT NULL, customer_id UUID DEFAULT NULL, valid BOOLEAN NOT NULL, currency VARCHAR(255) NOT NULL, total INT NOT NULL, sub_total INT NOT NULL, vat_total INT NOT NULL, comment VARCHAR(255) DEFAULT NULL, vat_percentage DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, biller_address_company_name VARCHAR(255) DEFAULT NULL, biller_address_street_line_one VARCHAR(255) DEFAULT NULL, biller_address_street_line_two VARCHAR(255) DEFAULT NULL, biller_address_city VARCHAR(255) DEFAULT NULL, biller_address_region VARCHAR(255) DEFAULT NULL, biller_address_country VARCHAR(255) DEFAULT NULL, biller_address_postcode VARCHAR(255) DEFAULT NULL, payee_address_company_name VARCHAR(255) DEFAULT NULL, payee_address_street_line_one VARCHAR(255) DEFAULT NULL, payee_address_street_line_two VARCHAR(255) DEFAULT NULL, payee_address_city VARCHAR(255) DEFAULT NULL, payee_address_region VARCHAR(255) DEFAULT NULL, payee_address_country VARCHAR(255) DEFAULT NULL, payee_address_postcode VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5399B6459395C3F3 ON receipt (customer_id)');
        $this->addSql('COMMENT ON COLUMN receipt.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN receipt.customer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE receipt_payment (receipt_id UUID NOT NULL, payment_id UUID NOT NULL, PRIMARY KEY(receipt_id, payment_id))');
        $this->addSql('CREATE INDEX IDX_7E6221F32B5CA896 ON receipt_payment (receipt_id)');
        $this->addSql('CREATE INDEX IDX_7E6221F34C3A3BB ON receipt_payment (payment_id)');
        $this->addSql('COMMENT ON COLUMN receipt_payment.receipt_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN receipt_payment.payment_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE receipt_subscription (receipt_id UUID NOT NULL, subscription_id UUID NOT NULL, PRIMARY KEY(receipt_id, subscription_id))');
        $this->addSql('CREATE INDEX IDX_32952A5C2B5CA896 ON receipt_subscription (receipt_id)');
        $this->addSql('CREATE INDEX IDX_32952A5C9A1887DC ON receipt_subscription (subscription_id)');
        $this->addSql('COMMENT ON COLUMN receipt_subscription.receipt_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN receipt_subscription.subscription_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE receipt_line (id UUID NOT NULL, receipt_id UUID DEFAULT NULL, currency VARCHAR(255) NOT NULL, total INT NOT NULL, sub_total INT NOT NULL, vat_total INT NOT NULL, description VARCHAR(255) DEFAULT NULL, vat_percentage DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_476F8F7A2B5CA896 ON receipt_line (receipt_id)');
        $this->addSql('COMMENT ON COLUMN receipt_line.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN receipt_line.receipt_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE refund (id UUID NOT NULL, payment_id UUID DEFAULT NULL, customer_id UUID DEFAULT NULL, billing_admin_id UUID DEFAULT NULL, amount INT NOT NULL, currency VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, external_reference VARCHAR(255) NOT NULL, reason VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5B2C14584C3A3BB ON refund (payment_id)');
        $this->addSql('CREATE INDEX IDX_5B2C14589395C3F3 ON refund (customer_id)');
        $this->addSql('CREATE INDEX IDX_5B2C14587CF7EBEC ON refund (billing_admin_id)');
        $this->addSql('COMMENT ON COLUMN refund.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN refund.payment_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN refund.customer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN refund.billing_admin_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE subscription (id UUID NOT NULL, payment_details_id UUID DEFAULT NULL, customer_id UUID DEFAULT NULL, price_id UUID DEFAULT NULL, subscription_plan_id UUID DEFAULT NULL, plan_name VARCHAR(255) DEFAULT NULL, payment_schedule VARCHAR(255) DEFAULT NULL, seats INT DEFAULT NULL, active BOOLEAN DEFAULT NULL, status VARCHAR(255) NOT NULL, amount INT DEFAULT NULL, has_trial BOOLEAN NOT NULL, trial_length_days INT DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, main_external_reference VARCHAR(255) DEFAULT NULL, main_external_reference_details_url VARCHAR(255) DEFAULT NULL, child_external_reference VARCHAR(255) DEFAULT NULL, started_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, valid_until TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, start_of_current_period TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, ended_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A3C664D38EEC86F7 ON subscription (payment_details_id)');
        $this->addSql('CREATE INDEX IDX_A3C664D39395C3F3 ON subscription (customer_id)');
        $this->addSql('CREATE INDEX IDX_A3C664D3D614C7E7 ON subscription (price_id)');
        $this->addSql('CREATE INDEX IDX_A3C664D39B8CE200 ON subscription (subscription_plan_id)');
        $this->addSql('COMMENT ON COLUMN subscription.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription.payment_details_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription.customer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription.price_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription.subscription_plan_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE subscription_payment (subscription_id UUID NOT NULL, payment_id UUID NOT NULL, PRIMARY KEY(subscription_id, payment_id))');
        $this->addSql('CREATE INDEX IDX_1E3D64969A1887DC ON subscription_payment (subscription_id)');
        $this->addSql('CREATE INDEX IDX_1E3D64964C3A3BB ON subscription_payment (payment_id)');
        $this->addSql('COMMENT ON COLUMN subscription_payment.subscription_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription_payment.payment_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE subscription_feature (id UUID NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6CC295FD77153098 ON subscription_feature (code)');
        $this->addSql('COMMENT ON COLUMN subscription_feature.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE subscription_plan (id UUID NOT NULL, product_id UUID DEFAULT NULL, public BOOLEAN NOT NULL, name VARCHAR(255) NOT NULL, code_name VARCHAR(255) DEFAULT NULL, external_reference VARCHAR(255) DEFAULT NULL, payment_provider_details_url VARCHAR(255) DEFAULT NULL, per_seat BOOLEAN DEFAULT NULL, is_free BOOLEAN DEFAULT NULL, user_count INT DEFAULT NULL, has_trial BOOLEAN DEFAULT NULL, trial_length_days INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EA664B6368C814C7 ON subscription_plan (code_name)');
        $this->addSql('CREATE INDEX IDX_EA664B634584665A ON subscription_plan (product_id)');
        $this->addSql('COMMENT ON COLUMN subscription_plan.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription_plan.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE subscription_plan_subscription_feature (subscription_plan_id UUID NOT NULL, subscription_feature_id UUID NOT NULL, PRIMARY KEY(subscription_plan_id, subscription_feature_id))');
        $this->addSql('CREATE INDEX IDX_63CBB01D9B8CE200 ON subscription_plan_subscription_feature (subscription_plan_id)');
        $this->addSql('CREATE INDEX IDX_63CBB01DA201F81C ON subscription_plan_subscription_feature (subscription_feature_id)');
        $this->addSql('COMMENT ON COLUMN subscription_plan_subscription_feature.subscription_plan_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription_plan_subscription_feature.subscription_feature_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE subscription_plan_price (subscription_plan_id UUID NOT NULL, price_id UUID NOT NULL, PRIMARY KEY(subscription_plan_id, price_id))');
        $this->addSql('CREATE INDEX IDX_5B8B27409B8CE200 ON subscription_plan_price (subscription_plan_id)');
        $this->addSql('CREATE INDEX IDX_5B8B2740D614C7E7 ON subscription_plan_price (price_id)');
        $this->addSql('COMMENT ON COLUMN subscription_plan_price.subscription_plan_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription_plan_price.price_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE subscription_plan_limit (id UUID NOT NULL, subscription_feature_id UUID DEFAULT NULL, subscription_plan_id UUID DEFAULT NULL, limit_number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EED5EDF9A201F81C ON subscription_plan_limit (subscription_feature_id)');
        $this->addSql('CREATE INDEX IDX_EED5EDF99B8CE200 ON subscription_plan_limit (subscription_plan_id)');
        $this->addSql('COMMENT ON COLUMN subscription_plan_limit.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription_plan_limit.subscription_feature_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscription_plan_limit.subscription_plan_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE team_invite_codes (id UUID NOT NULL, user_id UUID DEFAULT NULL, invited_user_id UUID DEFAULT NULL, team_id UUID DEFAULT NULL, code VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, used BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, used_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, cancelled BOOLEAN NOT NULL, role VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E05E9270A76ED395 ON team_invite_codes (user_id)');
        $this->addSql('CREATE INDEX IDX_E05E9270C58DAD6E ON team_invite_codes (invited_user_id)');
        $this->addSql('CREATE INDEX IDX_E05E9270296CD8AE ON team_invite_codes (team_id)');
        $this->addSql('COMMENT ON COLUMN team_invite_codes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN team_invite_codes.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN team_invite_codes.invited_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN team_invite_codes.team_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE teams (id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, billing_email VARCHAR(255) NOT NULL, external_customer_reference VARCHAR(255) DEFAULT NULL, payment_provider_details_url VARCHAR(255) DEFAULT NULL, billing_address_company_name VARCHAR(255) DEFAULT NULL, billing_address_street_line_one VARCHAR(255) DEFAULT NULL, billing_address_street_line_two VARCHAR(255) DEFAULT NULL, billing_address_city VARCHAR(255) DEFAULT NULL, billing_address_region VARCHAR(255) DEFAULT NULL, billing_address_country VARCHAR(255) DEFAULT NULL, billing_address_postcode VARCHAR(255) DEFAULT NULL, subscription_plan_name VARCHAR(255) DEFAULT NULL, subscription_payment_schedule VARCHAR(255) DEFAULT NULL, subscription_active BOOLEAN DEFAULT NULL, subscription_status VARCHAR(255) DEFAULT NULL, subscription_amount INT DEFAULT NULL, subscription_currency VARCHAR(255) DEFAULT NULL, subscription_started_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, subscription_valid_until TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, subscription_updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, subscription_ended_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, subscription_seats INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN teams.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE tier_component (id UUID NOT NULL, price_id UUID DEFAULT NULL, first_unit INT NOT NULL, last_unit INT DEFAULT NULL, unit_price INT NOT NULL, flat_fee INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A490D39D614C7E7 ON tier_component (price_id)');
        $this->addSql('COMMENT ON COLUMN tier_component.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN tier_component.price_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, team_id UUID DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, confirmation_code VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, activated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deactivated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_confirmed BOOLEAN NOT NULL, is_deleted BOOLEAN NOT NULL, roles TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1483A5E9296CD8AE ON users (team_id)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users.team_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users.roles IS \'(DC2Type:simple_array)\'');
        $this->addSql('ALTER TABLE charge_back ADD CONSTRAINT FK_250DACE84C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE charge_back ADD CONSTRAINT FK_250DACE89395C3F3 FOREIGN KEY (customer_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forgot_password_code ADD CONSTRAINT FK_B30A7571A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invite_codes ADD CONSTRAINT FK_E8D89FB2A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invite_codes ADD CONSTRAINT FK_E8D89FB2C58DAD6E FOREIGN KEY (invited_user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D9395C3F3 FOREIGN KEY (customer_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_subscription ADD CONSTRAINT FK_C536D3C94C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_subscription ADD CONSTRAINT FK_C536D3C99A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_card ADD CONSTRAINT FK_37970FA79395C3F3 FOREIGN KEY (customer_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D94584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE receipt ADD CONSTRAINT FK_5399B6459395C3F3 FOREIGN KEY (customer_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE receipt_payment ADD CONSTRAINT FK_7E6221F32B5CA896 FOREIGN KEY (receipt_id) REFERENCES receipt (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE receipt_payment ADD CONSTRAINT FK_7E6221F34C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE receipt_subscription ADD CONSTRAINT FK_32952A5C2B5CA896 FOREIGN KEY (receipt_id) REFERENCES receipt (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE receipt_subscription ADD CONSTRAINT FK_32952A5C9A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE receipt_line ADD CONSTRAINT FK_476F8F7A2B5CA896 FOREIGN KEY (receipt_id) REFERENCES receipt (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refund ADD CONSTRAINT FK_5B2C14584C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refund ADD CONSTRAINT FK_5B2C14589395C3F3 FOREIGN KEY (customer_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refund ADD CONSTRAINT FK_5B2C14587CF7EBEC FOREIGN KEY (billing_admin_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D38EEC86F7 FOREIGN KEY (payment_details_id) REFERENCES payment_card (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D39395C3F3 FOREIGN KEY (customer_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D39B8CE200 FOREIGN KEY (subscription_plan_id) REFERENCES subscription_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription_payment ADD CONSTRAINT FK_1E3D64969A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription_payment ADD CONSTRAINT FK_1E3D64964C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription_plan ADD CONSTRAINT FK_EA664B634584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription_plan_subscription_feature ADD CONSTRAINT FK_63CBB01D9B8CE200 FOREIGN KEY (subscription_plan_id) REFERENCES subscription_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription_plan_subscription_feature ADD CONSTRAINT FK_63CBB01DA201F81C FOREIGN KEY (subscription_feature_id) REFERENCES subscription_feature (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription_plan_price ADD CONSTRAINT FK_5B8B27409B8CE200 FOREIGN KEY (subscription_plan_id) REFERENCES subscription_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription_plan_price ADD CONSTRAINT FK_5B8B2740D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription_plan_limit ADD CONSTRAINT FK_EED5EDF9A201F81C FOREIGN KEY (subscription_feature_id) REFERENCES subscription_feature (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription_plan_limit ADD CONSTRAINT FK_EED5EDF99B8CE200 FOREIGN KEY (subscription_plan_id) REFERENCES subscription_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_invite_codes ADD CONSTRAINT FK_E05E9270A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_invite_codes ADD CONSTRAINT FK_E05E9270C58DAD6E FOREIGN KEY (invited_user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_invite_codes ADD CONSTRAINT FK_E05E9270296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tier_component ADD CONSTRAINT FK_5A490D39D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE charge_back DROP CONSTRAINT FK_250DACE84C3A3BB');
        $this->addSql('ALTER TABLE charge_back DROP CONSTRAINT FK_250DACE89395C3F3');
        $this->addSql('ALTER TABLE forgot_password_code DROP CONSTRAINT FK_B30A7571A76ED395');
        $this->addSql('ALTER TABLE invite_codes DROP CONSTRAINT FK_E8D89FB2A76ED395');
        $this->addSql('ALTER TABLE invite_codes DROP CONSTRAINT FK_E8D89FB2C58DAD6E');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840D9395C3F3');
        $this->addSql('ALTER TABLE payment_subscription DROP CONSTRAINT FK_C536D3C94C3A3BB');
        $this->addSql('ALTER TABLE payment_subscription DROP CONSTRAINT FK_C536D3C99A1887DC');
        $this->addSql('ALTER TABLE payment_card DROP CONSTRAINT FK_37970FA79395C3F3');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT FK_CAC822D94584665A');
        $this->addSql('ALTER TABLE receipt DROP CONSTRAINT FK_5399B6459395C3F3');
        $this->addSql('ALTER TABLE receipt_payment DROP CONSTRAINT FK_7E6221F32B5CA896');
        $this->addSql('ALTER TABLE receipt_payment DROP CONSTRAINT FK_7E6221F34C3A3BB');
        $this->addSql('ALTER TABLE receipt_subscription DROP CONSTRAINT FK_32952A5C2B5CA896');
        $this->addSql('ALTER TABLE receipt_subscription DROP CONSTRAINT FK_32952A5C9A1887DC');
        $this->addSql('ALTER TABLE receipt_line DROP CONSTRAINT FK_476F8F7A2B5CA896');
        $this->addSql('ALTER TABLE refund DROP CONSTRAINT FK_5B2C14584C3A3BB');
        $this->addSql('ALTER TABLE refund DROP CONSTRAINT FK_5B2C14589395C3F3');
        $this->addSql('ALTER TABLE refund DROP CONSTRAINT FK_5B2C14587CF7EBEC');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT FK_A3C664D38EEC86F7');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT FK_A3C664D39395C3F3');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT FK_A3C664D3D614C7E7');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT FK_A3C664D39B8CE200');
        $this->addSql('ALTER TABLE subscription_payment DROP CONSTRAINT FK_1E3D64969A1887DC');
        $this->addSql('ALTER TABLE subscription_payment DROP CONSTRAINT FK_1E3D64964C3A3BB');
        $this->addSql('ALTER TABLE subscription_plan DROP CONSTRAINT FK_EA664B634584665A');
        $this->addSql('ALTER TABLE subscription_plan_subscription_feature DROP CONSTRAINT FK_63CBB01D9B8CE200');
        $this->addSql('ALTER TABLE subscription_plan_subscription_feature DROP CONSTRAINT FK_63CBB01DA201F81C');
        $this->addSql('ALTER TABLE subscription_plan_price DROP CONSTRAINT FK_5B8B27409B8CE200');
        $this->addSql('ALTER TABLE subscription_plan_price DROP CONSTRAINT FK_5B8B2740D614C7E7');
        $this->addSql('ALTER TABLE subscription_plan_limit DROP CONSTRAINT FK_EED5EDF9A201F81C');
        $this->addSql('ALTER TABLE subscription_plan_limit DROP CONSTRAINT FK_EED5EDF99B8CE200');
        $this->addSql('ALTER TABLE team_invite_codes DROP CONSTRAINT FK_E05E9270A76ED395');
        $this->addSql('ALTER TABLE team_invite_codes DROP CONSTRAINT FK_E05E9270C58DAD6E');
        $this->addSql('ALTER TABLE team_invite_codes DROP CONSTRAINT FK_E05E9270296CD8AE');
        $this->addSql('ALTER TABLE tier_component DROP CONSTRAINT FK_5A490D39D614C7E7');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9296CD8AE');
        $this->addSql('DROP TABLE charge_back');
        $this->addSql('DROP TABLE forgot_password_code');
        $this->addSql('DROP TABLE invite_codes');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_subscription');
        $this->addSql('DROP TABLE payment_card');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE receipt');
        $this->addSql('DROP TABLE receipt_payment');
        $this->addSql('DROP TABLE receipt_subscription');
        $this->addSql('DROP TABLE receipt_line');
        $this->addSql('DROP TABLE refund');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE subscription_payment');
        $this->addSql('DROP TABLE subscription_feature');
        $this->addSql('DROP TABLE subscription_plan');
        $this->addSql('DROP TABLE subscription_plan_subscription_feature');
        $this->addSql('DROP TABLE subscription_plan_price');
        $this->addSql('DROP TABLE subscription_plan_limit');
        $this->addSql('DROP TABLE team_invite_codes');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE tier_component');
        $this->addSql('DROP TABLE users');
    }
}
