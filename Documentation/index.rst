.. include:: Includes.txt

=========
in2faq
=========

in2faq is a TYPO3 extension for managing FAQs consisting of questions and answers.
Contains a filter function and a cli command to import faq from extension irfaq.

.. only:: html

	:Copyright:
		2016 - 2023

	:Classification:
		in2faq

	:Version:
		7.1.0

	:Language:
		en

	:Keywords:
		faq, in2faq, irfaq, import, filter

	:Author:
		Alex Kellner, Sorin Loghin

	:Email:
		service@in2code.de



.. _overview:

Overview
========

The "in2faq" extension for TYPO3 provides a solution for managing Frequently Asked Questions (FAQs) on your website.
Features
--------

* **FAQ Management:** Easily manage a collection of frequently asked questions and answers.
* **Categorization:** Organize FAQs into categories for better navigation and filtering.
* **Filtering:** FAQs can be filtered by category or by text search of the questions.
* **CLI Command for Import:** Includes a command-line interface (CLI) command for importing FAQs from the "irfaq" extension.

.. _installation:

Installation
============

The extension can be installed as any other extension of TYPO3:

1. Switch to the module “Extension Manager”.
2. Get the extension
   a. Get it from the Extension Manager: Press the “Retrieve/Update” button and search for the extension key 'in2faq' and import the extension from the repository.
   b. Get it via composer: Run `composer require in2code/in2faq` in your console.
3. Activate the extension through the Extension Manager.

.. _configuration:

Configuration
=============

[Describe the configuration options here. Include any TypoScript settings, FlexForms, etc.]

.. _usage:

Usage
=====

1. Add faqs in list view in typo3 backend on a storage page of your choice.
2. Alternatively you can import faqs from the extension irfaq via cli command (see CLI Commands).
3. There are four different plugins to show the faqs in frontend:
   a. List view (cached) for display of all FAQs
   b. List view (uncached) for display of filtered FAQs
   c. Filter view
   d. Detail view for display of a single FAQ (question + answer)
4. Add the plugins to a page of your choice. For a page with a filterable list view you have to add the plugin "FAQ Filter" and the plugin"FAQ List View (uncached)".


.. _cli-commands:

CLI Commands
------------

The extension provides a CLI command for importing FAQs from the "irfaq" extension.
There is a dryRun option and an option to force import on a specific page id.

.. code-block:: bash

   ./bin/typo3 in2faq:importIrFaq --dryRun=1 --forcePid=1

The command will import all FAQs, categories and experts from the "irfaq" extension.
Caution: existing records will be truncated!


.. _contributors:

Contributors
============

- Alexander Kellner
- Sorin Loghin

.. _feedback:

Feedback and Support
====================

[Provide information on where to get support, how to contribute, or where to report bugs.]


