<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kristofvc\Component\Contact\Event\Listener;

use Doctrine\Common\Persistence\ObjectManager;
use Kristofvc\Component\Contact\Event\ContactEvent;
use Kristofvc\Component\Contact\Event\Listener\SuccessNoticeListener;
use Kristofvc\Component\Contact\Model\Contact;
use Kristofvc\Component\Contact\Provider\MessageProviderInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class SuccessNoticeListenerSpec
 * @package spec\Kristofvc\Component\Contact\Event\Listener
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin SuccessNoticeListener
 */
class SuccessNoticeListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Component\Contact\Event\Listener\SuccessNoticeListener');
    }

    function let(Session $session, MessageProviderInterface $messageProvider)
    {
        $this->beConstructedWith($session, $messageProvider);
    }

    function it_should_set_a_flash(
        Session $session,
        MessageProviderInterface $messageProvider,
        FlashBagInterface $flashBag
    ) {
        $contact = new Contact();
        $contact->setName('Kristof');
        $contact->setEmail('kristof@kristofvc.be');
        $contact->setMessage('Awesome website bro!');
        $message = 'Thank you for sending a message!';

        $messageProvider->getMessage($contact)->shouldBeCalled()->willReturn($message);
        $session->getFlashBag()->shouldBeCalled()->willReturn($flashBag);

        $flashBag->add('success-notice', $message)->shouldBeCalled();

        $contactEvent = ContactEvent::createWith($contact);
        $this->sendSuccessNotice($contactEvent);
    }
}
