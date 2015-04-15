<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Component\Contact\Mailer;

use Kristofvc\Component\Contact\Model\ContactInterface;

/**
 * Interface MailerInterface
 * @package Kristofvc\Component\Contact\Mailer
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
interface MailerInterface
{
    /**
     * Effectively send the mail
     *
     * @param $message
     */
    public function send($message);

    /**
     * Create a mail message
     * that can be send through the send method
     *
     * @param ContactInterface $contact
     *
     * @return mixed
     */
    public function createMessage(ContactInterface $contact);
}
