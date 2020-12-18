<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Kravchuk\ModuleAdder\Block\Html;

/**
 * Html pager block
 *
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @api
 * @since 100.0.2
 */
class Pager extends \Magento\Theme\Block\Html\Pager
{
    /**
     * The list of available pager limits
     *
     * @var array
     */
    protected $_availableLimit = [5 => 5, 10 => 10, 20 => 20, 50 => 50];
}
