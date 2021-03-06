PvMyBundle
==========

Installation
------------

To `composer.json`:


```json
{
    "require": {
        "pv/my-bundle": "*@dev"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:pvolok/PvMyBundle.git"
        }
    ]
}
```

To `AppKernel`:

```php
new Pv\MyBundle\PvMyBundle(),
```

Bootstrap forms
---------------

Add following to `config.yml`:

```yaml
twig:
    form:
        resources: [ 'PvMyBundle:Form:fields.html.twig' ]
```

Gen helper
----------

Helper for generated files.

Add following to `config.yml`:

```yaml
pv_my:
    gen:
        path: /path/to/gen
```

MongoDB session handler
----------------------

Add following to `config.yml`:

```yaml
framework:
    session:
        handler_id:  pv.mongo_session.handler

pv_my:
    mongo_session:
        database: db_name
```
