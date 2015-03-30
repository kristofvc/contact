<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kristofvc\Contact\Provider;

use Kristofvc\Contact\Provider\TranslatableMessageProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Translation\Translator;

/**
 * Class TranslatableMessageProviderSpec
 * @package spec\Kristofvc\Contact\Provider
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin TranslatableMessageProvider
 */
class TranslatableMessageProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Contact\Provider\TranslatableMessageProvider');
    }

    function let(Translator $translator)
    {
        $this->beConstructedWith($translator);
    }

    function it_should_implement_message_provider_interface()
    {
        $this->shouldImplement('Kristofvc\Contact\Provider\MessageProviderInterface');
    }
}
