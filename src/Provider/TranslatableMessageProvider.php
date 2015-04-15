<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Component\Contact\Provider;

use Kristofvc\Component\Contact\Model\ContactInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class TranslatableMessageProvider
 * @package Kristofvc\Component\Contact\Provider
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
final class TranslatableMessageProvider implements MessageProviderInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $domain;

    /**
     * @param TranslatorInterface $translator
     * @param string $key
     * @param string $domain
     */
    public function __construct(
        TranslatorInterface $translator,
        $key = 'kristofvc.contact.message.send',
        $domain = 'messages'
    ) {
        $this->translator = $translator;
        $this->key = $key;
        $this->domain = $domain;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(ContactInterface $contact)
    {
        return $this->translator->trans(
            $this->key,
            [
                '{{ name }}' => $contact->getName(),
                '{{ email }}' => $contact->getEmail(),
                '{{ message }}' => $contact->getMessage()
            ],
            $this->domain
        );
    }
}
