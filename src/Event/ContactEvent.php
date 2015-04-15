<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Component\Contact\Event;

use Kristofvc\Component\Contact\Model\ContactInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ContactEvent
 * @package Kristofvc\Component\Contact\Event
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
class ContactEvent extends Event
{
    /**
     * @var ContactInterface
     */
    private $contact;

    /**
     * @param ContactInterface $contact
     * @return ContactEvent
     */
    public static function createWith(ContactInterface $contact)
    {
        return new ContactEvent($contact);
    }

    /**
     * @param ContactInterface $contact
     */
    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return ContactInterface
     */
    public function getContact()
    {
        return $this->contact;
    }
}
