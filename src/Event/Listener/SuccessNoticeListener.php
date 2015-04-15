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
use Kristofvc\Component\Contact\Provider\MessageProviderInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class SuccessNoticeListener
 * @package Kristofvc\Component\Contact\Event\Listener
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
final class SuccessNoticeListener
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var MessageProviderInterface
     */
    private $messageProvider;

    /**
     * @param Session $session
     */
    public function __construct(Session $session, MessageProviderInterface $messageProvider)
    {
        $this->session = $session;
        $this->messageProvider = $messageProvider;
    }

    /**
     * Add a notice the message was successfully send
     */
    public function sendSuccessNotice(ContactEvent $contact)
    {
        $flashBag = $this->session->getFlashBag();
        $flashBag->add(
            'success-notice',
            $this->messageProvider->getMessage($contact->getContact())
        );
    }
}
