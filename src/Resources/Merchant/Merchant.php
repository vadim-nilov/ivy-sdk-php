<?php

namespace Ivy\Resources\Merchant;

use Ivy\Resources\ApiResource;
use Ivy\Resources\Common\Address;

/**
 * @property string $id
 * @property string $legalName
 * @property string $displayName
 * @property string $shopLogo
 * @property string $email
 * @property string $phone
 * @property string $mobilePhone
 * @property Address $address
 * @property string $category
 * @property string $websiteUrl
 * @property string $platformType
 * @property string $successCallbackUrl
 * @property string $errorCallbackUrl
 * @property string $quoteCallbackUrl
 * @property string $completeCallbackUrl
 * @property string $webhookUrl
 * @property string $offsetProject
 * @property string $invitedMail
 * @property string $privacyUrl
 * @property string $tosUrl
 */
final class Merchant extends ApiResource
{
}
