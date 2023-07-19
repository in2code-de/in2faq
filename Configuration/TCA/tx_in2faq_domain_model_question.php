<?php

use In2code\In2faq\Domain\Model\Category;
use In2code\In2faq\Domain\Model\Question;

return [
    'ctrl' => [
        'title' => 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:' . Question::TABLE_NAME,
        'label' => 'question',
        'tstamp' => 'tstamp',
        'sortby' => 'sorting',
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
        'iconfile' => 'EXT:in2faq/Resources/Public/Icons/' . Question::TABLE_NAME . '.svg',
    ],
    'types' => [
        '1' => [
            'showitem' =>
                'l10n_parent, sys_language_uid, question, path_segment, answer, categories',
        ],
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
                    ['label' =>'', 'value'=> 0],
                ],
                'default' => 0,
                'foreign_table' => Question::TABLE_NAME,
                'foreign_table_where' => 'AND ' . Question::TABLE_NAME . '.pid=###CURRENT_PID### AND ' .
                    Question::TABLE_NAME . '.sys_language_uid IN (-1,0)',
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
                'type' => 'check',
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
        'question' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:'
                . Question::TABLE_NAME . '.question',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],
        'answer' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:'
                . Question::TABLE_NAME . '.answer',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 6,
            ],
        ],
        'categories' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:'
                . Question::TABLE_NAME . '.categories',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => Category::TABLE_NAME,
                'foreign_table_where' => ' ORDER BY ' . Category::TABLE_NAME . '.title ASC',
                'MM' => 'tx_in2faq_question_category_mm',
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
            ],
        ],
        'path_segment' => [
            'label' => 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:'
                . Question::TABLE_NAME . '.path_segment',
            'exclude' => true,
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => [
                        'question',
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInPid',
                'default' => '',
            ],
        ],
    ],
];
