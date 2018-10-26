<?php
declare(strict_types = 1);
namespace LMS\Routes\Traits\Extbase;

/* * *************************************************************
 *
 *  Copyright notice
 *
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
 * ************************************************************* */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Mvc\Request as ExtbaseRequest;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait Request
{
    /**
     * Retrieve the Controller name
     *
     * @api
     * @param  string $controllerFQCN
     * @return string
     */
    public static function getControllerNameBasedOn(string $controllerFQCN): string
    {
        return Request::createInitialized($controllerFQCN)->getControllerName();
    }

    /**
     * Retrieve Extension name from the request
     *
     * @api
     * @param  string $controllerFQCN
     * @return string
     */
    public static function getExtensionNameBasedOn(string $controllerFQCN): string
    {
        return Request::createInitialized($controllerFQCN)->getControllerExtensionName();
    }

    /**
     * Retrieve the Vendor prefix
     *
     * @api
     * @param  string $controllerFQCN
     * @return string
     */
    public static function getVendorNameBasedOn(string $controllerFQCN): string
    {
        return Request::createInitialized($controllerFQCN)->getControllerVendorName();
    }

    /**
     * Create the fresh instance of Extbase Request
     *
     * @param  string $controllerFQCN
     * @return ExtbaseRequest|Object
     */
    private static function createInitialized(string $controllerFQCN): ExtbaseRequest
    {
        $request = Request::create();
        $request->setControllerObjectName($controllerFQCN);

        return $request;
    }

    /**
     * Create the fresh instance of Extbase Request
     *
     * @return ExtbaseRequest|Object
     */
    private static function create(): ExtbaseRequest
    {
        /** @var ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);

        return $objectManager->get(ExtbaseRequest::class);
    }
}
