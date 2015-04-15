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
 * Interface MessageProviderInterface
 * @package Kristofvc\Component\Contact\Provider
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
interface MessageProviderInterface
{
    /**
     * This method should return the message
     * you want to do something with in your application
     *
     * @param ContactInterface $contact
     * @return string
     */
    public function getMessage(ContactInterface $contact);
}
