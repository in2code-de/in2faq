<?php

##############################################################
# Extension Manager/Repository config file for ext "in2faq". #
##############################################################

$EM_CONF[$_EXTKEY] = [
    'title' => 'in2faq',
    'description' => 'Simple and modern FAQ extension with a cli command to import faq from extension irfaq',
    'category' => 'misc',
    'author' => 'in2code GmbH',
    'author_email' => 'service@in2code.de',
    'state' => 'stable',
    'author_company' => 'in2code GmbH',
    'version' => '5.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0 - 11.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
