ck  # Clean PHP Data Reader

Clean PHP (no framework, except testing) MVC Application :blush:

Requires Docker & docker-compose to run

## Description
* Data reader for CVS, XML & JSON formats.
* All commands are run through `make` command. For full reference check `Makefile`
* [Easy Coding Standard](https://github.com/symplify/easy-coding-standard) is used, configuration file `ecs.php`.
* Latest version of PHPUnit is used for testing

## Step by step
* Application configuration is in `public/config.yaml` file
* in `public/config.yaml` XML & CSV are enabled, JSON disabled, simply change false to true to enable JSON format
* run `make start` - this builds docker containers and starts application
* run `make test-full` - to run coding standard check & PHPUnit tests
* open [Data Reader Application in Web Browser](http://nginx.reader/)
* application url is `http://nginx.reader/` if **dockerhost** is running properly
* play with Application using data stored in `tests/data` folder
* run `make clean` - to stop Application, remove Docker containers, all installed files by composer and test cache

Other commands in `Makefile` were used during development
