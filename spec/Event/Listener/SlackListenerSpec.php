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

use Kristofvc\Component\Contact\Event\ContactEvent;
use Kristofvc\Component\Contact\Event\Listener\SlackListener;
use Kristofvc\Component\Contact\Http\ClientInterface;
use Kristofvc\Component\Contact\Model\Contact;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class SlackListenerSpec
 * @package spec\Kristofvc\Component\Contact\Event\Listener
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin SlackListener
 */
class SlackListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Component\Contact\Event\Listener\SlackListener');
    }

    function let(ClientInterface $client)
    {
        $this->beConstructedWith($client, 'http://incoming-webhook-url');
    }

    function it_should_set_a_message_to_slack(ClientInterface $client)
    {
        $contact = new Contact();
        $contact->setName('Kristof');
        $contact->setEmail('kristof@kristofvc.be');
        $contact->setMessage('Awesome website bro!');

        $data = [
            'text' => $contact->getMessage(),
            'channel' => '#general',
            'username' => $contact->getName() . ' (' . $contact->getEmail() . ')',
            'icon_emoji' => ':envelope:'
        ];

        $client->createPostRequest('http://incoming-webhook-url', $data)->shouldBeCalled()->willReturn('request');
        $client->send('request')->shouldBeCalled();

        $contactEvent = ContactEvent::createWith($contact);
        $this->pushMessage($contactEvent);
    }
}
