<?php

namespace Kravchuk\ModuleAdder\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

// date-base tables: patch_list cms_block
/**
 * Class CmsFooterSocial
 * @package Kravchuk\ModuleAdder\Setup\Patch\Data
 */
class CmsFooterSocial implements DataPatchInterface, PatchVersionInterface
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
        <div class="footer-social">
            <div class="social-icons">
                <a href="https://www.facebook.com" class="social-link social-facebook"></a>
                <a href="https://www.pinterest.com" class="social-link social-pinterest"></a>
                <a href="https://www.linkedin.com" class="social-link social-linkedin"></a>
                <a href="https://www.youtube.com" class="social-link social-youtube"></a>
                <a href="https://www.instagram.com" class="social-link social-instagram"></a>
                <a href="https://irishstore.com/blog" class="social-link social-blog"></a>
            </div>
            <div class="social-text">
                <p>To stay up to date with all our special offers and great new Irish products</p>
            </div>
            <div class="social-satisfy">
                <div class="social-satisfy--percent">98%</div>
                <div class="social-satisfy--text">CUSTOMER SATISFACTION</div>
            </div>
        </div>
        EOD;
        $newCmsStaticBlock = [
            'title' => 'Footer Social networks',
            'identifier' => 'footer-social',
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
