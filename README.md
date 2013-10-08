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
