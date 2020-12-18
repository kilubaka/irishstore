<?php

namespace Kravchuk\ModuleAdder\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

// date-base tables: patch_list cms_block
/**
 * Class CmsContentWeloveit
 * @package Kravchuk\ModuleAdder\Setup\Patch\Data
 */
class CmsContentWeloveit implements DataPatchInterface, PatchVersionInterface
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
        <div class="weLoveIt-block">
            <div class="weLoveIt-title">
              Why We Love It
            </div>
            <div class="weLoveIt-items">
                <div class="weLoveIt-item">
                    <div class="weLoveIt-item__content">
                        <img src="{{view url="images/weloveit/Weloveit-1.jpg"}}" alt="Merino Wool" class="weLoveIt-item__content-img">
                        <div class="weLoveIt-item__content-title">Donegal Merino Wool</div>
                        <div class="weLoveIt-item__content-border"></div>
                        <div class="weLoveIt-item__content-text">Luxuriously soft easy-to-wear merino yarn in 4 irresistible colors.</div>
                    </div>
                </div>
                <div class="weLoveIt-item">
                    <div class="weLoveIt-item__content">
                        <img src="{{view url="images/weloveit/Weloveit-2.jpg"}}" alt="Classic Sweater" class="weLoveIt-item__content-img">
                        <div class="weLoveIt-item__content-title">Classic Aran Sweater</div>
                        <div class="weLoveIt-item__content-border"></div>
                        <div class="weLoveIt-item__content-text">A must-have wardrobe staple with its classic crew neck. Team with your favorite jeans for the ultimate casual look.</div>
                    </div>
                </div>
                <div class="weLoveIt-item">
                    <div class="weLoveIt-item__content">
                        <img src="{{view url="images/weloveit/Weloveit-3.jpg"}}" alt="Craftsmanship" class="weLoveIt-item__content-img">
                        <div class="weLoveIt-item__content-title">Exquisite Aran Craftsmanship</div>
                        <div class="weLoveIt-item__content-border"></div>
                        <div class="weLoveIt-item__content-text">Lucky honeycomb stitch in the main body beautifully trimmed with classic cable.</div>
                    </div>
                </div>
            </div>
            <div class="weLoveIt-action">
              <button class="scroll-up">Get Yours Today</button>
            </div>
        </div>
        <script>
            require(['jquery'], function ($) {
                $('.scroll-up').on('click', function (){
                    $('html,body').animate({scrollTop: $("header").offset().top},'slow');
                });
            });
        </script>
        EOD;
        $newCmsStaticBlock = [
            'title' => 'Content WhyWeLoveIt',
            'identifier' => 'weLoveIt-block',
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
