<?php

namespace Kristofvc\Contact\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ContactType
 * @package Kristofvc\Contact\Form\Type
 */
class ContactType extends AbstractType implements ContactTypeInterface
{
    /**
     * @var bool
     */
    private $hasRecaptcha = false;

    /**
     * @var string
     */
    private $dataClass;

    /**
     * @param $hasRecaptcha
     * @param string $dataClass
     */
    public function __construct($hasRecaptcha, $dataClass = 'Kristofvc\Contact\Model\Contact')
    {
        $this->hasRecaptcha = $hasRecaptcha;
        $this->dataClass = $dataClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            'text',
            [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Name',
                    'tabindex' => 1
                ]
            ]
        );

        $builder->add(
            'email',
            'email',
            [
                'required' => true,
                'attr' => [
                    'placeholder' => 'E-mail',
                    'tabindex' => 1
                ]
            ]
        );

        if ($this->hasRecaptcha) {
            $builder->add('recaptcha', 'ewz_recaptcha');
        }

        $builder->add(
            'message',
            'textarea',
            [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Message',
                    'tabindex' => 1,
                    'rows' => 7
                ]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'contact_type';
    }
}
