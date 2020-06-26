# Extension to read specific fields from files

## Getting started

### Install

Add new **require** to your `composer.json` file:

``
"akazak/file-reader-extension": "dev-master"
``

Add new section **repositories** (if it doesn't exist) and repo:

```
"repositories": [
    {
        "type": "vcs",
        "url":  "https://github.com/AKazak/FileReader"
    }
],
```

Run `composer update`

### Usage

```
use AKazak\FileReader\Reader;

$instance = new Reader();

$entities = $instance->getInfo(__DIR__ . '/to_upload.json', ['login', 'firstname', 'lastname', 'email']);
```

