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
use Kristofvc\Component\Contact\Event\Listener\PersistenceListener;
use Kristofvc\Component\Contact\Model\Contact;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PersistenceListenerSpec
 * @package spec\Kristofvc\Component\Contact\Event\Listener
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin PersistenceListener
 */
class PersistenceListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Component\Contact\Event\Listener\PersistenceListener');
    }

    function let(ObjectManager $objectManager)
    {
        $this->beConstructedWith($objectManager);
    }

    function it_should_save_the_object(ObjectManager $objectManager)
    {
        $contact = new Contact();
        $contact->setName('Kristof');
        $contact->setEmail('kristof@kristofvc.be');
        $contact->setMessage('Awesome website bro!');

        $objectManager->persist($contact)->shouldBeCalled();
        $objectManager->flush()->shouldBeCalled();

        $contactEvent = ContactEvent::createWith($contact);
        $this->save($contactEvent);
    }
}
