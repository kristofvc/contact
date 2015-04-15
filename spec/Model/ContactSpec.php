<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kristofvc\Component\Contact\Model;

use Kristofvc\Component\Contact\Model\Contact;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ContactSpec
 * @package spec\Kristofvc\Component\Contact\Model
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin Contact
 */
class ContactSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Component\Contact\Model\Contact');
    }

    function it_should_implement_contact_interface()
    {
        $this->shouldImplement('Kristofvc\Component\Contact\Model\ContactInterface');
    }

    function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    function it_can_fetch_the_name()
    {
        $this->setName('Kristof');
        $this->getName()->shouldReturn('Kristof');
    }

    function it_has_no_email_by_default()
    {
        $this->getEmail()->shouldReturn(null);
    }

    function it_can_fetch_the_email()
    {
        $this->setEmail('kristof@kristofvc.be');
        $this->getEmail()->shouldReturn('kristof@kristofvc.be');
    }

    function it_has_no_message_by_default()
    {
        $this->getMessage()->shouldReturn(null);
    }

    function it_can_fetch_the_message()
    {
        $this->setMessage('Cool website bro!');
        $this->getMessage()->shouldReturn('Cool website bro!');
    }

    function it_can_fetch_the_subject()
    {
        $this->setName('Kristof');
        $this->getSubject()->shouldReturn('Contact by Kristof');
    }

    function it_initializes_created_at_by_default()
    {
        $this->getCreatedAt()->shouldHaveType('\DateTime');
    }
}
