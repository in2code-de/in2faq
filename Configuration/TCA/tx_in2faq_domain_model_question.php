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
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
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
        'iconfile' => 'EXT:in2faq/Resources/Public/Icons/' . Question::TABLE_NAME . '.svg'
    ],
    'interface' => [
        'showRecordFieldList' =>
            'l10n_parent, sys_language_uid, hidden, question, answer, categories',
    ],
    'types' => [
        '1' => [
            'showitem' =>
                'l10n_parent, sys_language_uid, question, answer, categories'
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.sorting',
                'items' => [
                    ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
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
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0
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
                'foreign_table_where' => ' ORDER BY ' . Category::TABLE_NAME . '.sorting ASC',
                'MM' => 'tx_in2faq_question_category_mm',
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
            ],
        ],
    ],
];
