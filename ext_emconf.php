<?php

##############################################################
# Extension Manager/Repository config file for ext "in2faq". #
##############################################################

$EM_CONF[$_EXTKEY] = [
    'title' => 'in2faq',
    'description' => 'Simple FAQ extension with a cli command to import faq from extension irfaq',
    'category' => 'misc',
    'author' => 'in2code GmbH',
    'author_email' => 'service@in2code.de',
    'state' => 'stable',
    'author_company' => 'in2code GmbH',
    'version' => '7.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0 - 12.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
