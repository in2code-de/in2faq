=================
Local development
=================

A ddev development environment is provided (adapted from https://github.com/a-r-m-i-n/ddev-for-typo3-extensions ).

How to use ddev envirmonment
============================

Install ddev (https://ddev.readthedocs.io/en/stable/#installation) and run the following commands:

1. First time start - setup you evenvironment: `ddev initialize`
2. Start containers: `ddev start`
3. Installation: `ddev composer install`

There is a db dump with some test data in `.project/data/v12 `. You can import it with `ddev db-restore`.
The dump contains some FAQs and categories and some irfaq records for testing the CLI import command.

Test CLI import command (example):
`ddev ssh`
`.Build/bin/typo3 in2faq:importIrFaq --dryRun=1 --forcePid=1`

Logins
======

TYPO3 Backend
-------------

* https://in2faq.ddev.site/typo3

user: `admin`
password: `Password:joh316`

(also as Install Tool password)

Databases
---------

* v12
    user: `db`
    password: `db`
