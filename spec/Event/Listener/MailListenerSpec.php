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
use Kristofvc\Component\Contact\Mailer\MailerInterface;
use Kristofvc\Component\Contact\Event\Listener\MailListener;
use Kristofvc\Component\Contact\Model\Contact;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class MailListenerSpec
 * @package spec\Kristofvc\Component\Contact\Event\Listener
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin MailListener
 */
class MailListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Component\Contact\Event\Listener\MailListener');
    }

    function let(MailerInterface $mailer)
    {
        $this->beConstructedWith($mailer);
    }

    function it_should_save_the_object(MailerInterface $mailer, \Swift_Message $message)
    {
        $contact = new Contact();
        $contact->setName('Kristof');
        $contact->setEmail('kristof@kristofvc.be');
        $contact->setMessage('Awesome website bro!');

        $mailer->createMessage($contact)->shouldBeCalled()->willReturn($message);
        $mailer->send($message)->shouldBeCalled();

        $contactEvent = ContactEvent::createWith($contact);
        $this->sendMail($contactEvent);
    }
}
