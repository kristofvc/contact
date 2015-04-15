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
 * Class SwiftMailer
 * @package Kristofvc\Component\Contact\Mailer
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
final class SwiftMailer implements MailerInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $to;

    /**
     * @param \Swift_Mailer $mailer
     * @param $from
     * @param $to
     */
    public function __construct(\Swift_Mailer $mailer, $from, $to)
    {
        $this->mailer = $mailer;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @param $message
     */
    public function send($message)
    {
        $this->mailer->send($message);
    }

    /**
     * @param ContactInterface $contact
     *
     * @return \Swift_Mime_MimePart
     */
    public function createMessage(ContactInterface $contact)
    {
        return \Swift_Message::newInstance()
            ->setSubject($contact->getSubject())
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setReplyTo($contact->getEmail())
            ->setBody($contact->getMessage());
    }
}
