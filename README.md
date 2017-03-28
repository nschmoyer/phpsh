**phpsh** is, for lack of a better term, a configurable command line parser and interpreter. It is not a REPL
in that it doesn't allow users to execute PHP code inside of it. Rather, it contains its own command definitions
that are defined as classes.
 
Out of the box, phpsh doesn't allow for much of anything at all. It comes with an extremely basic set of commands
(`help`, `exit`, `commands`, etc.). The purpose of this project is to serve as a starting point for larger command line 
projects.

## Current Features

* Extensible command interpreter
* Customizable prompt
* Execute commands on startup and shutdown

## Installation

1. Install third-party libraries via composer: `composer install`
2. In a command-line shell, run `php bin/phpsh`

## Configuring and Extending phpsh

phpsh will search for a `phpsh.yml` file in the following directories of your project:

* /
* /config
* /app
* /app/config

### phpsh.yml configuration file

The configuration file defines your custom commands and prompt, and follows this format:

    prompt: "string containing prompt # "
    commands:
        command_name:
            class: \Namespace\Class
            args: 0
        command_name:
            class: \Namespace\Class
            args: 2

### Writing commands

* Commands are written as PHP classes that extend `phpsh\Command`
* All commands must include, at the very least, an `exec()` function
* Commands can accept one or more arguments which are accessed via `getArgs()`

