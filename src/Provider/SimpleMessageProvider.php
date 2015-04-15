<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Component\Contact\Provider;

use Kristofvc\Component\Contact\Model\ContactInterface;

/**
 * Class SimpleMessageProvider
 * @package Kristofvc\Component\Contact\Provider
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
final class SimpleMessageProvider implements MessageProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(ContactInterface $contact)
    {
        return sprintf('Thank you for sending me a message %s!', $contact->getName());
    }
}
