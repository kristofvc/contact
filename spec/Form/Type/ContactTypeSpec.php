<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kristofvc\Component\Contact\Form\Type;

use Kristofvc\Component\Contact\Form\Type\ContactType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ContactTypeSpec
 * @package spec\Kristofvc\Component\Contact\Form\Type
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
        $this->shouldHaveType('Kristofvc\Component\Contact\Form\Type\ContactType');
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    function it_should_implement_contact_type_interface()
    {
        $this->shouldImplement('Kristofvc\Component\Contact\Form\Type\ContactTypeInterface');
        $this->shouldImplement('Symfony\Component\Form\FormTypeInterface');
    }

    function let()
    {
        $this->beConstructedWith(false, 'Kristofvc\Component\Contact\Model\Contact');
    }

    function it_should_build_form_with_chosen_fields(FormBuilder $builder)
    {
        $builder->add('name', 'text', Argument::any())->willReturn($builder);
        $builder->add('email', 'email', Argument::any())->willReturn($builder);
        $builder->add('message', 'textarea', Argument::any())->willReturn($builder);

        $this->buildForm($builder, []);
    }

    function it_should_use_injected_data_class(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => 'Kristofvc\Component\Contact\Model\Contact'
                ]
            )
            ->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }

    function it_can_fetch_the_name()
    {
        $this->getName()->shouldReturn('contact_type');
    }

    function it_can_fetch_the_set_name()
    {
        $this->beConstructedWith(true, 'Kristofvc\Component\Contact\Model\Contact', 'other_type');
        $this->getName()->shouldReturn('other_type');
    }
}
