<?php

##############################################################
# Extension Manager/Repository config file for ext "in2faq". #
##############################################################

$EM_CONF[$_EXTKEY] = array(
    'title' => 'in2faq',
    'description' => 'Simple and modern FAQ extension with a CommandController to import faq from extension irfaq',
    'category' => 'misc',
    'author' => 'in2code GmbH',
    'author_email' => 'service@in2code.de',
    'dependencies' => 'extbase, fluid',
    'state' => 'stable',
    'author_company' => 'in2code GmbH',
    'version' => '1.0.0',
    'constraints' => array(
        'depends' => array(
            'php' => '5.5.0-0.0.0',
            'typo3' => '7.6.0-8.6.1',
            'extbase' => '7.6.0-8.6.1',
            'fluid' => '7.6.0-8.6.1'
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
);
