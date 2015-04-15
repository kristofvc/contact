<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Component\Contact\Event\Listener;

use Doctrine\Common\Persistence\ObjectManager;
use Kristofvc\Component\Contact\Event\ContactEvent;

/**
 * Class PersistenceListener
 * @package Kristofvc\Component\Contact\Event\Listener
 *
 * @author Hans Stevens <hnsstvns@gmail.com>
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
final class PersistenceListener
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Save a message in a database
     *
     * @param ContactEvent $event
     */
    public function save(ContactEvent $event)
    {
        $contact = $event->getContact();

        $this->manager->persist($contact);
        $this->manager->flush();
    }
}
