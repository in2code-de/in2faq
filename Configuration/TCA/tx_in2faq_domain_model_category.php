<?php

use In2code\In2faq\Domain\Model\Category;

return [
    'ctrl' => [
        'title' => 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:' . Category::TABLE_NAME,
        'label' => 'title',
        'tstamp' => 'tstamp',
        'default_sortby' => 'ORDER BY title ASC',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => 'EXT:in2faq/Resources/Public/Icons/' . Category::TABLE_NAME . '.svg',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, title'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' =>'', 'value' => 0],
                ],
                'default' => 0,
                'foreign_table' => Category::TABLE_NAME,
                'foreign_table_where' => 'AND ' . Category::TABLE_NAME . '.pid=###CURRENT_PID### AND ' .
                    Category::TABLE_NAME . '.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
            ],
        ],
        'title' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:'
                . Category::TABLE_NAME . '.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
    ],
];
