<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
 *  All rights reserved
 *
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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

/**
 * Writer outputs JSON notation of a tree
 *
 * @package Tree
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_PtExtbase_Tree_JsonTreeWriter extends Tx_PtExtbase_Tree_ArrayTreeWriter
{
    /**
     * Creates a new instance of json writer
     *
     * @param array $visitors
     * @return Tx_PtExtbase_Tree_JsonTreeWriter
     */
    public static function getInstance(array $visitors = [])
    {
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');

        $arrayWriterVisitor = $objectManager->get('Tx_PtExtbase_Tree_ArrayWriterVisitor');
        /** @var Tx_PtExtbase_Tree_ArrayWriterVisitor $arrayWriterVisitor */

        $visitors[] = $arrayWriterVisitor;
        $jsonTreeWriter = $objectManager->get('Tx_PtExtbase_Tree_JsonTreeWriter', $visitors, $arrayWriterVisitor);
        return $jsonTreeWriter;
    }


    /**
     * Constructor for array tree writer
     *
     * @param array $visitors
     * @param \Tx_PtExtbase_Tree_ArrayWriterVisitor|\Tx_PtExtbase_Tree_TreeWalkerVisitorInterface $arrayWriterVisitor
     */
    public function __construct(array $visitors, Tx_PtExtbase_Tree_TreeWalkerVisitorInterface $arrayWriterVisitor)
    {
        parent::__construct($visitors, $arrayWriterVisitor);
    }


    /**
     * Returns JSON notation of given tree
     *
     * @param Tx_PtExtbase_Tree_TreeInterface $tree
     * @return string JSON encoding of tree
     */
    public function writeTree(Tx_PtExtbase_Tree_TreeInterface $tree)
    {
        $nodeArray = parent::writeTree($tree);

        return '[' . json_encode($nodeArray) . ']';
    }
}
