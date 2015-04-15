<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kristofvc\Component\Contact\Provider;

use Kristofvc\Component\Contact\Model\Contact;
use Kristofvc\Component\Contact\Provider\TranslatableMessageProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Translation\Translator;

/**
 * Class TranslatableMessageProviderSpec
 * @package spec\Kristofvc\Component\Contact\Provider
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin TranslatableMessageProvider
 */
class TranslatableMessageProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Component\Contact\Provider\TranslatableMessageProvider');
    }

    function let(Translator $translator)
    {
        $this->beConstructedWith($translator, 'message.token', 'custom_catalogue');
    }

    function it_should_implement_message_provider_interface()
    {
        $this->shouldImplement('Kristofvc\Component\Contact\Provider\MessageProviderInterface');
    }

    function it_should_call_trans_with_the_right_values(Translator $translator)
    {
        $contact = new Contact();
        $contact->setName('Kristof');
        $contact->setEmail('kristof@kristofvc.be');
        $contact->setMessage('Awesome website bro!');

        $translator->trans(
            'message.token',
            [
                '{{ name }}' => $contact->getName(),
                '{{ email }}' => $contact->getEmail(),
                '{{ message }}' => $contact->getMessage()
            ],
            'custom_catalogue'
        )->shouldBeCalled();

        $this->getMessage($contact);
    }
}
