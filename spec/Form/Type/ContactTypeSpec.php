<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kristofvc\Contact\Form\Type;

use Kristofvc\Contact\Form\Type\ContactType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ContactTypeSpec
 * @package spec\Kristofvc\Contact\Form\Type
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 * @author Hans Stevens <hnsstvns@gmail.com>
 *
 * @mixin ContactType
 */
class ContactTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Contact\Form\Type\ContactType');
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    function it_should_implement_contact_type_interface()
    {
        $this->shouldImplement('Kristofvc\Contact\Form\Type\ContactTypeInterface');
        $this->shouldImplement('Symfony\Component\Form\FormTypeInterface');
    }

    function let()
    {
        $this->beConstructedWith(true, 'Kristofvc\Contact\Model\Contact');
    }

    function it_can_fetch_the_name()
    {
        $this->getName()->shouldReturn('contact_type');
    }

    function it_can_fetch_the_set_name()
    {
        $this->beConstructedWith(true, 'Kristofvc\Contact\Model\Contact', 'other_type');
        $this->getName()->shouldReturn('other_type');
    }
}
