<?php
namespace In2code\In2faq\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 in2code GmbH <info@in2code.de>, in2code.de
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use In2code\In2faq\Utility\ObjectUtility;
use TYPO3\CMS\Core\Database\QueryGenerator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class QuestionRepository
 * @package In2code\In2faq\Domain\Repository
 */
class QuestionRepository extends Repository
{

    /**
     * @var string
     */
    protected $treeList = null;

    /**
     * @param array $settings
     * @return array|QueryResultInterface
     */
    public function findBySettings(array $settings)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $and = [$query->greaterThan('uid', 0)];
        if ($this->getPagesFromStartpage($settings)) {
            $and[] = $query->in('pid', $this->getPagesFromStartpage($settings));
        }
        if (!empty($settings['flexform']['main']['categories'])) {
            $categoryUids = GeneralUtility::trimExplode(',', $settings['flexform']['main']['categories'], true);
            $or = [];
            foreach ($categoryUids as $categoryUid) {
                $or[] = $query->equals('categories.uid', (int)$categoryUid);
            }
            $and[] = $query->logicalOr($or);
        }
        $query->matching($query->logicalAnd($and));
        $query->setOrderings(['sorting' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }

    /**
     * @param array $settings
     * @return array|null
     */
    protected function getPagesFromStartpage(array $settings)
    {
        if ($this->treeList === null && !empty($settings['flexform']['main']['startpid'])) {
            $treeList = '';
            $startPages = GeneralUtility::trimExplode(',', $settings['flexform']['main']['startpid'], true);
            $queryGenerator = ObjectUtility::getObjectManager()->get(QueryGenerator::class);
            foreach ($startPages as $startPage) {
                $treeList .= $queryGenerator->getTreeList($startPage, 20, 0, 1) . ',';
            }
            return GeneralUtility::trimExplode(',', $treeList, true);
        }
        return $this->treeList;
    }
}
