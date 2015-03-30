<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Contact\Event\Listener\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Kristofvc\Contact\Event\ContactEvent;

/**
 * Class PersistenceListener
 * @package Kristofvc\Contact\Event\Listener
 *
 * @author Hans Stevens <hnsstvns@gmail.com>
 */
final class PersistenceListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * Send a message to slack with the data that was submitted in the contact form
     *
     * @param ContactEvent $event
     */
    public function persist(ContactEvent $event)
    {
        $contact = $event->getContact();

        $this->entityManager->persist($contact);
        $this->entityManager->flush();
    }
}
