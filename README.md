# Pluralizer Library
[![Build Status](https://travis-ci.com/cristianoc72/pluralizer.svg?branch=master)](https://travis-ci.com/cristianoc72/pluralizer)
[![Maintainability](https://api.codeclimate.com/v1/badges/d68768bff27eca05e258/maintainability)](https://codeclimate.com/github/cristianoc72/pluralizer/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/d68768bff27eca05e258/test_coverage)](https://codeclimate.com/github/cristianoc72/pluralizer/test_coverage)
[![StyleCI](https://github.styleci.io/repos/141529674/shield?branch=master)](https://github.styleci.io/repos/141529674)
[![License: MIT](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://opensource.org/licenses/MIT)

Pluralizer is a pluralize/singularize library, extracted from [Propel Orm](https://github.com/propelorm/Propel3) codebase.

## Install

Via Composer

``` bash
$ composer require cristianoc72/pluralizer
```

## Usage

The library exposes two methods: `getPluralForm`, which transforms a word from singular to plural, and `getSinguarForm`
doing the opposite.

``` php
$pluralizer = new cristianoc72\Pluralizer();

$plural = $pluralizer->getPluralForm('Author');
echo $plural; // Authors

$singular = $pluralizer->getSingularForm('Books');
echo $singular; // Book
```

The library can transform the most common irregular words:

``` php
$pluralizer = new cristianoc72\Pluralizer();

$plural = $pluralizer->getPluralForm('tooth');
echo $plural; // teeth
```

Besides, the library exposes two checker method `isPlural` and `isSingular`:

```php
$pluralizer = new cristianoc72\Pluralizer();

var_dump($pluralizer->isPlural('Author'); // (bool) false

var_dump($pluralizer->isPlural('Books'));  // (bool) true
```

## Testing

Simply run:
``` bash
$ vendor/bin/phpunit
```
A directory `coverage` will be automatically created and it contains the code coverage report.

## Contributing

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github](https://github.com/cristianoc72/pluralizer).

When you submit a Pull Request, please follow this recommendations:

- [PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) - Check the code style and fix it via [Php CS Fixer](https://cs.sensiolabs.org/)

- Add tests! - Your patch won't be accepted if it doesn't have tests.

- Document any change in behaviour - Make sure the `README.md` is kept up-to-date.

- Send coherent history - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

## Versions ##

- **0.x**: Developmnet versions. v0.5 can be considered stable. PHP 5.6 support.
- **1.x**: Stable versions. PHP >= 7.1

## Credits

- Paul Hanssen
- Hans Lellelid
- [Cristiano Cinotti](https://github.com/cristianoc72)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
