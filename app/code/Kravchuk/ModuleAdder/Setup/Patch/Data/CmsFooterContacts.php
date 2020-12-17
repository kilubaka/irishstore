<?php

namespace Kravchuk\ModuleAdder\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

// date-base tables: patch_list cms_block
/**
 * Class CmsFooterContacts
 * @package Kravchuk\ModuleAdder\Setup\Patch\Data
 */
class CmsFooterContacts implements DataPatchInterface, PatchVersionInterface
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
        <address class="contacts">
            <div class="contacts-inner">
                <div class="contacts-address">
                    <strong>THE IRISH STORE</strong>
                    <div class="address-suite">Suite 6.</div>
                    <div class="address-street">7 Upper O'Connell Street, Dublin 1, Ireland</div>
                </div>

                <div class="contacts-contact">
                    <div>
                        <strong>USA/CANADA:</strong>
                        <a title="Call Us" href="tel: 18007075037" class="contact-USA">1800 707 5037 (toll free to Ireland)</a>
                    </div>
                    <div>
                        <strong>International:</strong>
                        <a title="Call Us" href="tel: +35318611590" class="contact-international">+353 186 11 590</a>
                    </div>
                    <div>
                        <strong>Email:</strong>
                        <a title="Contact Us" href="mailto: info@theirishstore.com" class="contact-mail">info@theirishstore.com</a>
                    </div>
                </div>

                <div class="contacts-payment">
                    <strong>100% SECURE SHOPPING CART</strong>
                    <div class="payment-providers"></div>
                </div>
            </div>
        </address>
        EOD;
        $newCmsStaticBlock = [
            'title' => 'Footer Contacts',
            'identifier' => 'footer-contacts',
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
