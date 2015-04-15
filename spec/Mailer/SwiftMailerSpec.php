<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kristofvc\Component\Contact\Mailer;

use Doctrine\Common\Persistence\ObjectManager;
use Kristofvc\Component\Contact\Mailer\SwiftMailer;
use Kristofvc\Component\Contact\Model\Contact;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class SwiftMailerSpec
 * @package spec\Kristofvc\Component\Contact\Event\Listener
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin SwiftMailer
 */
class SwiftMailerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Component\Contact\Mailer\SwiftMailer');
    }

    function let(\Swift_Mailer $mailer)
    {
        $this->beConstructedWith($mailer, 'no-reply@kristofvc.be', 'info@kristofvc.be');
    }

    function it_should_create_a_message()
    {
        $contact = new Contact();
        $contact->setName('Kristof');
        $contact->setEmail('kristof@kristofvc.be');
        $contact->setMessage('Awesome website bro!');

        $this->createMessage($contact)->shouldHaveType('\Swift_Message');
    }

    function it_should_send_a_message(\Swift_Mailer $mailer, \Swift_Message $message)
    {
        $mailer->send($message)->shouldBeCalled();

        $this->send($message);
    }
}
