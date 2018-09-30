Tube Status
=============
[![Build Status](https://travis-ci.org/ianlchapman/tube-status.svg?branch=master)](https://travis-ci.org/ianlchapman/tube-status)
[![Latest Stable Version](https://poser.pugx.org/ianlchapman/tube-status/v/stable)](https://packagist.org/packages/ianlchapman/tube-status)
[![Total Downloads](https://poser.pugx.org/ianlchapman/tube-status/downloads)](https://packagist.org/packages/ianlchapman/tube-status)
[![Latest Unstable Version](https://poser.pugx.org/ianlchapman/tube-status/v/unstable)](https://packagist.org/packages/ianlchapman/tube-status)
[![License](https://poser.pugx.org/ianlchapman/tube-status/license)](https://packagist.org/packages/ianlchapman/tube-status)


A library that integrates with the TFL Tube Status API to show the status of London Underground lines using PHP.


Features
------------
* Pulls tube lines from the [TFL API](https://api.tfl.gov.uk/)
* Shows the current status of the lines as exposed by the TFL API
* Suite of unit tests

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ianlchapman/tube-status "*"
```

or add

```
"ianlchapman/tube-status": "*"
```

to the require section of your `composer.json` file.


Usage
-----

1. First you need to get an Application ID and Application Key from the [TFL API](https://api.tfl.gov.uk/). Details are available on the API's website [https://api.tfl.gov.uk/](https://api.tfl.gov.uk/).

2. Pull the status of all the London Underground (tube) lines.
```php
use IanLChapman\TubeStatus\TubeStatus;

$statusService = new TubeStatus;
$statusService->setApplicationId('APPLICATION_ID'); // replace these values with information from the TFL API
$statusService->setApplicationKey('APPLICATION_KEY');
$statusService->getTubeStatus($client);
```

The call returns an array of tube lines including some basic information as well as their status.