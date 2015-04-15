# How to use the persistence listener in Symfony2 with ORM

Follow the docs on [how to integrate the component with Symfony2](https://github.com/kristofvc/contact/blob/master/doc/symfony-integration.md).

## Add an Entity to `src/Acme/Demo/Entity` 

```php
    <?php
    
    namespace Acme\Demo\Entity;
    
    use Kristofvc\Component\Contact\Model\AbstractContact as BaseContact;
    
    /**
     * Class Contact
     * @package Acme\Demo\Entity
     */
    class Contact extends BaseContact
    {
        private $id;
    
        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }
    
        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }
    }
```

## Add a mapping for this entity to `app/config/doctrine`

```xml
    <?xml version="1.0" encoding="utf-8"?>
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
                      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                      xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">
        
        <entity name="Acme\Demo\Entity\Contact" table="contact">
            <id name="id" type="integer" column="id">
                <generator strategy="AUTO"/>
            </id>
        </entity>
        
    </doctrine-mapping>
``` 

## Add some configuration for your new entity

```yml
    doctrine:
        ...
        
        orm:
            auto_generate_proxy_classes: "%kernel.debug%"
            default_entity_manager: acme_demo_contact
            entity_managers:
                acme_demo_contact:
                    mappings:
                        acme_demo_contact:
                            type: xml
                            prefix: Acme\Demo\Entity
                            dir: %kernel.root_dir%/config/doctrine
                        kristofvc_contact:
                            type: xml
                            prefix: Kristofvc\Component\Contact\Model
                            dir: %kernel.root_dir%/../vendor/kristofvc/component/contact/src/Resources/config/doctrine
                            
        ...                    
```
 
## Change the ContactType service
 
```xml
    <service id="kristofvc_contact.form.type.contact" class="Kristofvc\Component\Contact\Form\Type\ContactType">
        <argument>false</argument>
        <argument>Acme\Demo\Entity\Contact</argument>
    </service>
```
 
## Add a service for the listener

```xml
    <service id="kristofvc_contact.event.persistence_listener" class="Kristofvc\Component\Contact\Event\Listener\PersistenceListener">
        <argument type="service" id="doctrine.orm.acme_demo_contact_entity_manager" />
        <tag name="kernel.event_listener" event="contact.contact_submit_success_event" method="save" />
    </service>
``` 