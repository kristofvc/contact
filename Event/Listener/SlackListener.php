<?php

namespace Kristofvc\Contact\Event\Listener;

use Guzzle\Http\ClientInterface;
use Kristofvc\Contact\Event\ContactEvent;

/**
 * Class SlackListener
 * @package Kristofvc\Contact\Event\Listener
 */
final class SlackListener
{
    /**
     * @var string
     */
    private $incomingWebhookUrl;

    /**
     * @var string
     */
    private $channel;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param ClientInterface $client
     * @param $incomingWebhookUrl
     * @param string $channel
     * @param string $icon
     */
    public function __construct(ClientInterface $client, $incomingWebhookUrl, $channel = '#general', $icon = ':envelope:')
    {
        $this->incomingWebhookUrl = $incomingWebhookUrl;
        $this->channel = $channel;
        $this->icon = $icon;
        $this->client = $client;
    }

    /**
     * @param ContactEvent $event
     */
    public function pushMessage(ContactEvent $event)
    {
        $contact = $event->getContact();

        $data = [
            'text' => $contact->getMessage(),
            'channel' => $this->channel,
            'username' => $contact->getName() . ' (' . $contact->getEmail() . ')',
            'icon_emoji' => $this->icon
        ];

        $request = $this->client->createRequest('POST', $this->incomingWebhookUrl, [], json_encode($data));
        $request->send();
    }
}