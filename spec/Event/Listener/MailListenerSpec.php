<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kristofvc\Contact\Event\Listener;

use Doctrine\Common\Persistence\ObjectManager;
use Kristofvc\Contact\Event\ContactEvent;
use Kristofvc\Contact\Event\Listener\MailListener;
use Kristofvc\Contact\Model\Contact;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class MailListenerSpec
 * @package spec\Kristofvc\Contact\Event\Listener
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin MailListener
 */
class MailListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Contact\Event\Listener\MailListener');
    }

    function let(\Swift_Mailer $mailer)
    {
        $this->beConstructedWith($mailer, 'contact@kristofvc.be', 'info@kristofvc.be');
    }

    function it_should_save_the_object(\Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $contact->setName('Kristof');
        $contact->setEmail('kristof@kristofvc.be');
        $contact->setMessage('Awesome website bro!');

        $mailer->send(Argument::type('\Swift_Message'))->shouldBeCalled();

        $contactEvent = ContactEvent::createWith($contact);
        $this->sendMail($contactEvent);
    }
}