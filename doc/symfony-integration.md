# How to use the component with Symfony 2

## Add some services

```xml
        <service id="kristofvc_contact.controller.contact" class="Kristofvc\Component\Contact\Controller\Contact">
            <argument type="service" id="templating" />
            <argument type="service" id="form.factory" />
            <argument type="service" id="event_dispatcher" />
            <argument type="service" id="kristofvc_contact.form.type.contact" />
            <argument>:Main:contact.html.twig</argument>
        </service>

        <service id="kristofvc_contact.mailer.swift" class="Kristofvc\Component\Contact\Mailer\SwiftMailer">
            <argument type="service" id="mailer" />
            <argument>%mailer_from%</argument>
            <argument>%mailer_to%</argument>
        </service>

        <service id="kristofvc_contact.event.mail_listener" class="Kristofvc\Component\Contact\Event\Listener\MailListener">
            <argument type="service" id="kristofvc_contact.mailer.swift" />
            <tag name="kernel.event_listener" event="contact.contact_submitted_event" method="sendMail" />
        </service>

        <service id="kristofvc_contact.provider.simple_message" class="Kristofvc\Component\Contact\Provider\SimpleMessageProvider" />

        <service id="kristofvc_contact.event.success_notice_listener" class="Kristofvc\Component\Contact\Event\Listener\SuccessNoticeListener">
            <argument type="service" id="session" />
            <argument type="service" id="kristofvc_contact.provider.simple_message" />
            <tag name="kernel.event_listener" event="contact.contact_submitted_event" method="sendSuccessNotice" />
        </service>

        <service id="kristofvc_contact.form.type.contact" class="Kristofvc\Component\Contact\Form\Type\ContactType">
            <argument>false</argument>
        </service>
```

You can add other services in the Event-folder, or your own services the same way.

## Add a route

```yml
    kristofvc_controller_main_contact:
        path: /contact
        defaults: { _controller: kristofvc_contact.controller.contact:__invoke }
        methods: ["GET", "POST"]
```

## Activate the validation in app/config/AppKernel.php

```php
    public function boot()
    {
        parent::boot();
    
        $validatorBuilder = $this->getContainer()->get('validator.builder');
        $validatorBuilder->addXmlMappings([
            __DIR__.'/../vendor/kristofvc/contact/src/Resources/config/validation/Contact.validation.xml'
        ]);
    }
```

## Add a template under app/Resources/views/Main/contact.html.twig

```twig
    {% extends "::base.html.twig" %}
    
    {% block body %}
        <div class="container">
            <div class="row marketing">
                <div class="col-sm-11 col-sm-offset-1">
                    <h2 class="pull-left marketing-title">Get in touch</h2>
                    <div class="clearfix"></div>
                    {% if app.request.session.flashBag.has('success-notice')|length > 0 %}
                        <p class="pull-left marketing-byline-success marketing-byline">{% for message in app.request.session.flashBag.get('success-notice') %}{{ message }}{% endfor %}</p>
                    {% else %}
                        <p class="pull-left marketing-byline">Fill out the form below!</p>
                    {% endif %}
                </div>
            </div>
            {{ form_start(form) }}
                <div class="col-sm-6">
                    {{ form_row(form.name) }}
                    {{ form_row(form.email) }}
                    {% if form.recaptcha is defined %}
                        {{ form_row(form.recaptcha) }}
                    {% endif %}
                </div>
                <div class="col-sm-6">
                    {{ form_row(form.message) }}
                    <div class="form-group">
                        <button class="btn btn-primary pull-right" type="submit">Send <i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            {{ form_end(form) }}
        </div>
    {% endblock body %}
```
