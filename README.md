# Contact 
[![Build Status](https://travis-ci.org/kristofvc/contact.svg)](https://travis-ci.org/kristofvc/contact) 
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/cce4c027-116c-4475-9650-e0afc41391d0/mini.png)](https://insight.sensiolabs.com/projects/cce4c027-116c-4475-9650-e0afc41391d0)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kristofvc/contact/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kristofvc/contact/?branch=master)

This is a component that includes a controller to render a contact-form and then throws an event when the contact-form is submitted.
This way listeners can handle the submission and send a mail, set a notice, etc...

Since the controller throws an event when the form is submitted and valid it's easy to add your own listeners. 

## Installing the component with composer

```
    "require": {
        ...
        "kristofvc/contact": "~1.0"
    }
```

## About

### Documentation

The documentation is stored in the `doc/index.md` file in this bundle:

[Read the Documentation for master](https://github.com/kristofvc/contact/blob/master/doc/index.md)

### Author

Kristof Van Cauwenbergh - <kristof.vancauwenbergh@gmail.com> - <http://kristofvc.be>.
See also the list of [contributors](https://github.com/kristofvc/contact/contributors) that participated in this project.

### License

kristofvc/contact is licensed under the MIT License - see the `meta/LICENSE` file for details.

### Contributing

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/kristofvc/contact/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project
to allow developers of the component to reproduce the issue by simply cloning this project.

Feel free to fork this project, to contribute and to send pull requests.
