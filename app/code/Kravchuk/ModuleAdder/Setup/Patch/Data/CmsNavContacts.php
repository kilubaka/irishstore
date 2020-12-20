<?php

namespace Kravchuk\ModuleAdder\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

// date-base tables: patch_list cms_block
/**
 * Class CmsNavContacts
 * @package Kravchuk\ModuleAdder\Setup\Patch\Data
 */
class CmsNavContacts implements DataPatchInterface, PatchVersionInterface
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
        <div class="nav-contacts">
            <div class="widget block block-static-block">
                <div class="contact-us-in-mobile-nav-menu">
                    <div><strong>THE IRISH STORE</strong></div>
                    <div>Suite 6,</div>
                    <div>5-7 Upper O'Connell Street,</div>
                    <div style="margin-bottom: 8px;">Dublin 1, Ireland</div>
                    <div><strong>USA/CANADA:</strong> <a href="tel:18007075037">1800 707 5037 (toll free)</a></div>
                    <div><strong>INTERNATIONAL:</strong> <a href="tel:+35318611590">+353 1 8611590</a></div>
                    <div><strong>HEAD OFFICE:</strong> <a href="tel:+35318228040">+353 1 822 8040</a></div>
                    <div><strong>EMAIL:</strong> <a href="mailto:info@theirishstore.com"> info@theirishstore.com</a></div>
                </div>
            </div>
        </div>
        EOD;
        $newCmsStaticBlock = [
            'title' => 'Navigation Contacts',
            'identifier' => 'nav-contacts',
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
