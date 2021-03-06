<?php

##############################################################
# Extension Manager/Repository config file for ext "in2faq". #
##############################################################

$EM_CONF[$_EXTKEY] = array(
    'title' => 'in2faq',
    'description' => 'Simple and modern FAQ extension with a cli command to import faq from extension irfaq',
    'category' => 'misc',
    'author' => 'in2code GmbH',
    'author_email' => 'service@in2code.de',
    'dependencies' => '',
    'state' => 'stable',
    'author_company' => 'in2code GmbH',
    'version' => '4.1.1',
    'constraints' => array(
        'depends' => array(
            'typo3' => '9.5.0-10.99.99',
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
);
