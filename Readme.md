# EXT:in2faq

To render questions and answers as TYPO3 extension as a possible follower for EXT:irfaq.

![Example output of the faq extension](Documentation/Images/screenshot_in2faq_frontend.png "Example output")

## Explanation

There are two plugins. The first plugin shows the questions and answers. The second allows you to set a filter over your
question list. There is a filter by search term and a category filter.

A command controller allows you to import old EXT:irfaq records into new tables

## Early Access Programm for TYPO3 13 support

:information_source: **TYPO3 13 compatibility**
> See [EAP page (DE)](https://www.in2code.de/agentur/typo3-extensions/early-access-programm/) or
> [EAP page (EN)](https://www.in2code.de/en/agency/typo3-extensions/early-access-program/) for more information how
> to get access to a TYPO3 13 version



## Changelog

| Version | Date       | State      | Description                                                                                                                          |
|---------|------------| ---------- |--------------------------------------------------------------------------------------------------------------------------------------|
| 13.0.0   | tbd       | Task       | TYPO3 v13 compatibility - planned                                                                                                    |                      
| 7.0.0   | 2023-12-25 | Task       | Support PHP 8.1 and TYPO3 v12, provide link to detail page in list views, provide flexform configurations  for detail view           |
| 6.0.0   | 2022-09-14 | Task       | Support PHP 8 now, updated CS fixer settings, prevent error with filter plugin above list plugin                                     |
| 5.1.3   | 2022-05-24 | Bugfix     | Raise field length for path_segment in DB definition                                                                                 |
| 5.1.2   | 2021-11-18 | Bugfix     | Fix broken sorting for categories (automatic by title) also for FlexForms for Pi1 and Pi2                                            |
| 5.1.1   | 2021-11-18 | Bugfix     | Fix broken sorting for categories (automatic by title) and questions (manual by sorting field) in backend                            |
| 5.1.0   | 2021-11-18 | Task       | Support PHP 7.2 and 7.3 again, added automatic tests via github actions                                                              |
| 5.0.0   | 2021-09-29 | Breaking   | New major release: Drop support for TYPO3 V8 and V9; Compatible with TYPO3 V11; 2 new plugins; Support slugs (incl. upgrade wizard); |
| 4.1.4   | 2021-07-13 | Task       | Small code cleanup                                                                                                                   |
| 4.1.3   | 2021-06-28 | Bugfix     | Set default value in TCA for `l10n_parent`                                                                                           |
| 4.1.1   | 2019-04-08 | Bugfix     | Don't use same startpage for plugins when plugin is inserted more then once per page                                                 |
| 4.1.0   | 2019-02-13 | Feature    | Pi2: Show categories from given startpoint. If empty, show all. Also pass tt_content.* to views.                                     |
| 4.0.1   | 2019-02-11 | Bugfix     | Remove unneeded version from composer.json.                                                                                          |
| 4.0.0   | 2019-02-10 | Task       | Update for newer TYPO3 versions. Add a filter functionality.                                                                         |
| 3.0.0   | 2019-03-31 | Task       | Update for TYPO3 9                                                                                                                   |
| 2.0.3   | 2019-03-31 | Task       | Update dependencies                                                                                                                  |
| 2.0.2   | 2019-03-31 | Task       | Update dependencies                                                                                                                  |
| 2.0.1   | 2017-08-04 | Bugfix     | Small bugfix                                                                                                                         |
| 2.0.0   | 2017-06-06 | Task       | Preperations for TYPO3 8                                                                                                             |
| 1.0.0   | 2016-07-26 | Task       | Initial release                                                                                                                      |

