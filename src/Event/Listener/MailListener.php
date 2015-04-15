<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Component\Contact\Event\Listener;

use Kristofvc\Component\Contact\Event\ContactEvent;
use Kristofvc\Component\Contact\Mailer\MailerInterface;

/**
 * Class MailListener
 * @package Kristofvc\Component\Contact\Event\Listener
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
final class MailListener
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send a mail with the data that was submitted in the contact form
     *
     * @param ContactEvent $event
     */
    public function sendMail(ContactEvent $event)
    {
        $contact = $event->getContact();

        $message = $this->mailer->createMessage($contact);
        $this->mailer->send($message);
    }
}
