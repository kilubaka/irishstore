<?php

namespace Kravchuk\ModuleAdder\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

// date-base tables: patch_list cms_block
/**
 * Class CmsFooterLinks
 * @package Kravchuk\ModuleAdder\Setup\Patch\Data
 */
class CmsFooterLinks implements DataPatchInterface, PatchVersionInterface
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
        <div class="footer-links__column">
            <p class="column-title">HOW CAN WE HELP?</p>
            <ul class="column-list">
                <li class="column-link"><a href="https://support.irishstore.com/hc/en-us">Help Center</a></li>
                <li class="column-link"><a href="https://irishstore.com/order-tracking">Order Tracking</a></li>
                <li class="column-link"><a href="https://irishstore.com/contact-us">Contact Us</a></li>
                <li class="column-link"><a href="https://irishstore.com/returns-policy">Free Returns</a></li>
                <li class="column-link"><a href="https://irishstore.com/delivery-information">Delivery &amp; Shipping</a></li>
                <li class="column-link"><a href="https://irishstore.com/vat">Tax Information</a></li>
                <li class="column-link"><a href="https://irishstore.com/covid-19-update">COVID-19</a></li>
            </ul>
        </div>
        <div class="footer-links__column">
            <p class="column-title">ABOUT US</p>
            <ul class="column-list">
                <li class="column-link"><a href="https://irishstore.com/our-story">Our Story</a></li>
                <li class="column-link"><a href="https://irishstore.com/privacy">Security Privacy Policy</a></li>
                <li class="column-link"><a href="https://irishstore.com/sitemap">Sitemap</a></li>
                <li class="column-link"><a href="https://irishstore.com/terms-conditions">Terms &amp; Conditions</a></li>
            </ul>
        </div>
        <div class="footer-links__column">
            <p class="column-title">USEFUL INFORMATION</p>
            <ul class="column-list">
                <li class="column-link"><a href="https://irishstore.com/size-guide">Size Charts</a></li>
                <li class="column-link"><a href="https://irishstore.com/blog/">Blog</a></li>
                <li class="column-link"><a href="https://irishstore.com/catalogs">Catalog</a></li>
            </ul>
        </div>
        <div class="footer-links__column">
            <p class="column-title">POPULAR PRODUCTS</p>
            <ul class="column-list">
                <li class="column-link"><a href="https://irishstore.com/aran-sweaters">Aran Sweaters</a></li>
                <li class="column-link"><a href="https://irishstore.com/celtic-jewelry/tree-of-life">Tree of Life</a></li>
                <li class="column-link"><a href="https://irishstore.com/celtic-jewelry/celtic">Celtic Knot Jewelry</a></li>
                <li class="column-link"><a href="https://irishstore.com/irish-art/blessings-prints">Irish Blessings</a></li>
                <li class="column-link"><a href="https://irishstore.com/celtic-jewelry/claddagh/claddagh-rings">Claddagh Rings</a></li>
                <li class="column-link"><a href="https://irishstore.com/celtic-jewelry/claddagh/claddagh-rings/mens">Men's Claddagh Rings</a></li>
                <li class="column-link"><a href="https://irishstore.com/celtic-jewelry/trinity-knot/rings">Trinity Knot Rings</a></li>
            </ul>
        </div>
        EOD;
        $newCmsStaticBlock = [
            'title' => 'Footer Links',
            'identifier' => 'footer-links',
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
