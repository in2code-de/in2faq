<?php
use In2code\In2faq\Domain\Model\Category;
use In2code\In2faq\Domain\Model\Expert;
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
        'versioningWS' => 2,
        'versioning_followPages' => true,
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
        'iconfile' => 'EXT:in2faq/Resources/Public/Icons/' . Question::TABLE_NAME . '.gif'
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
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
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
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
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
                'cols' => 40,
                'rows' => 6
            ],
            'defaultExtras' => 'richtext[]'
        ],
        'categories' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:'
                . Question::TABLE_NAME . '.categories',
            'config' => [
                'type' => 'select',
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
