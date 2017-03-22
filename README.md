**phpsh** is, for lack of a better term, a configurable command line parser and interpreter. It is not a REPL
in that it doesn't allow users to execute PHP code inside of it. Rather, it contains its own command definitions
that are defined as classes.
 
Out of the box, phpsh doesn't allow for much of anything at all. It comes with an extremely basic set of commands
(`help`, `exit`, `commands`, etc.). The purpose of this project is to serve as a starting point for larger command line 
projects.

## Current Features

* Extensible command interpreter
* Customizable prompt

## Planned Features

* Access to databases using PDO
* Access to Firebase apps

## Installation

1. Install third-party libraries via composer: `composer install`
2. In a command-line shell, run `php bin/phpsh`

## Configuration

The various config files are located in the `src/phpsh/config` directory.

* **commands.yml**: Contains command mappings for the application.
* **prompt.yml**: Contains the prompt configuration.

## Extending phpcs

### Writing commands

* Commands are written as PHP classes that extend `phpsh\Command`
* All commands must include, at the very least, an `exec()` function
* Commands can accept one or more arguments which are accessed via `getArgs()`

