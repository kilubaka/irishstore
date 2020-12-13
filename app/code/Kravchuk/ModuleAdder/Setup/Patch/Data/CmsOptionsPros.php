<?php

namespace Kravchuk\ModuleAdder\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

// date-base tables: patch_list cms_block
/**
 * Class CmsOptionsPros
 * @package Kravchuk\ModuleAdder\Setup\Patch\Data
 */
class CmsOptionsPros implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * AddAccessViolationPageAndAssignB2CCustomers constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $blockFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $my_var = <<<EOD
            <div class="product-pros__block" style="">
                <ul class="product-pros-list" style="margin-top: 15px; padding-left: 15px; font-family: Roboto, Helvetica, Arial, sans-serif;">
                    <li style="margin-bottom: 0;">Five star customer reviews</li>
                    <li style="margin-bottom: 0;">Beautifully crafted from Donegal merino yarn</li>
                    <li style="margin-bottom: 0;">Features the classic honeycomb Aran stitch</li>
                    <li style="margin-bottom: 0;">Model is a US size 8-10 and wears size M</li>
                </ul>
            </div>
        EOD;
        $newCmsStaticBlock = [
            'title' => 'Options Advantages Block',
            'identifier' => 'product-pros-block',
            'content' => $my_var,
            'is_active' => 1,
            'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
        ];

        $this->moduleDataSetup->startSetup();

        /** @var \Magento\Cms\Model\Block $block */
        $block = $this->blockFactory->create();
        $block->setData($newCmsStaticBlock)->save();

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '2.0.0';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
