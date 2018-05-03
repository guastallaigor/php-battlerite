<div align="center">
    <img src="/assets/battlerite.png" width="128px">
    <h1>PHP Battlerite</h1>
</div>

<p align="center">
    PHP Battlerite is an easy composer PHP API to get all the data you need from the [Developer Battlerite API](https://developer.battlerite.com).
</p>

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/guastallaigor/php-battlerite/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/guastallaigor/php-battlerite/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/guastallaigor/php-battlerite/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/guastallaigor/php-battlerite/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/guastallaigor/php-battlerite/badges/build.png?b=master)](https://scrutinizer-ci.com/g/guastallaigor/php-battlerite/build-status/master)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/guastallaigor/php-battlerite/blob/master/LICENSE)

## Project directory

```
.
+-- .editorconfig
+-- .gitattributes
+-- .scrutinizer.yml
+-- .travis.yml
+-- .gitignore
+-- composer.json
+-- composer.lock
+-- LICENSE
+-- phpunit.xml
+-- README.md
+-- assets
|   +-- battlerite.png
+-- src
|   +-- Config.php
|   +-- Main.php
|   +-- Config
|   |   +-- phpbattlerite.php
|   +-- Exceptions
|   |   +-- ConfigFileNotFoundException.php
|   |   +-- Exception.php
|   +-- Facedes
|   |   +-- PhpBattleriteFacede.php
|   +-- ServiceProviders
|   |   +-- PhpBattleriteServiceProvider.php
+-- tests
|   +-- PhpBattleriteTest.php
|   +-- TestCase.php
+-- vendor
```

## Contributing [![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/dwyl/esta/issues)

Thanks for considering contributing to PHP Battlerite!

We welcome any type of contribution, not only code. You can help with:
- **QA**: File bug reports, the more details you can give the better (e.g. screenshots with the console open)
- **Community**: Presenting the project at meetups, organizing a dedicated meetup for the local community
- **Code**: Take a look at the [open issues](https://github.com/guastallaigor/php-battlerite/issues). Even if you can't write the code yourself, you can comment on them, showing that you care about a given issue matters. It helps us triage them

## Development

...

## TODO

* [ ] Add all the requests available at [Developer Battlerite API](https://developer.battlerite.com).
* [ ] Test on Laravel 5.5+.
* [ ] Make a full README.md.
* [ ] Add Travis CI.
* [ ] Publish package on packagist.

## License

MIT © [guastallaigor](https://github.com/guastallaigor/php-battlerite)
