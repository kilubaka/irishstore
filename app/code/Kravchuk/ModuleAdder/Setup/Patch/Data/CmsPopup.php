<?php

namespace Kravchuk\ModuleAdder\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

// date-base tables: patch_list cms_block
/**
 * Class CmsPopup
 * @package Kravchuk\ModuleAdder\Setup\Patch\Data
 */
class CmsPopup implements DataPatchInterface, PatchVersionInterface
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
        <div class="size-chart-content">
            <button id="tab-button-in" class="tab-button in">Inches</button>
            <button id="tab-button-cm" class="tab-button cm inactive">Centimeters</button>
            <table class="table_size cm">
                <tbody>
                    <tr>
                        <th><strong>Our Sizing</strong></th>
                        <th><strong>XS</strong></th>
                        <th><strong>S</strong></th>
                        <th><strong>M</strong></th>
                        <th><strong>L</strong></th>
                        <th><strong>XL</strong></th>
                        <th><strong>XXL</strong></th>
                    </tr>
                    <tr>
                        <td><strong>Chest</strong></td>
                          <td>48</td>
                          <td>50</td>
                          <td>52</td>
                          <td>54</td>
                          <td>56</td>
                          <td>58</td>
                    </tr>
                    <tr>
                        <td><strong>Waist</strong></td>
                        <td>48</td>
                        <td>50</td>
                        <td>52</td>
                        <td>54</td>
                        <td>56</td>
                        <td>58</td>
                    </tr>
                    <tr>
                        <td><strong>Hips</strong></td>
                        <td>48</td>
                        <td>50</td>
                        <td>52</td>
                        <td>54</td>
                        <td>56</td>
                        <td>58</td>
                    </tr>
                    <tr>
                        <td><strong>Length</strong></td>
                        <td>64</td>
                        <td>66</td>
                        <td>68</td>
                        <td>70</td>
                        <td>72</td>
                        <td>74</td>
                    </tr>
                    <tr>
                        <td><strong>Arm Length</strong></td>
                        <td>78</td>
                        <td>79</td>
                        <td>80</td>
                        <td>82</td>
                        <td>83</td>
                        <td>85</td>
                    </tr>
                    <tr>
                        <td><strong>Width</strong></td>
                        <td>48</td>
                        <td>50</td>
                        <td>52</td>
                        <td>54</td>
                        <td>56</td>
                        <td>58</td>
                    </tr>
                </tbody>
            </table>
            <table class="table_size in active">
                <tbody>
                    <tr>
                        <th><strong>Our Sizing</strong></th>
                        <th><strong>XS</strong></th>
                        <th><strong>S</strong></th>
                        <th><strong>M</strong></th>
                        <th><strong>L</strong></th>
                        <th><strong>XL</strong></th>
                        <th><strong>XXL</strong></th>
                    </tr>
                    <tr>
                        <td><strong>Chest</strong></td>
                        <td>18.9</td>
                        <td>19.7</td>
                        <td>20.5</td>
                        <td>21.3</td>
                        <td>22.0</td>
                        <td>22.8</td>
                    </tr>
                    <tr>
                        <td><strong>Waist</strong></td>
                        <td>18.9</td>
                        <td>19.7</td>
                        <td>20.5</td>
                        <td>21.3</td>
                        <td>22.0</td>
                        <td>22.8</td>
                    </tr>
                    <tr>
                        <td><strong>Hips</strong></td>
                        <td>18.9</td>
                        <td>19.7</td>
                        <td>20.5</td>
                        <td>21.3</td>
                        <td>22.0</td>
                        <td>22.8</td>
                    </tr>
                    <tr>
                        <td><strong>Length</strong></td>
                        <td>25.2</td>
                        <td>26.0</td>
                        <td>26.8</td>
                        <td>27.6</td>
                        <td>28.3</td>
                        <td>29.1</td>
                    </tr>
                    <tr>
                        <td><strong>Arm Length</strong></td>
                        <td>30.7</td>
                        <td>31.1</td>
                        <td>31.5</td>
                        <td>32.3</td>
                        <td>32.7</td>
                        <td>33.5</td>
                    </tr>
                    <tr>
                        <td><strong>Width</strong></td>
                        <td>18.9</td>
                        <td>19.7</td>
                        <td>20.5</td>
                        <td>21.3</td>
                        <td>22.0</td>
                        <td>22.8</td>
                    </tr>
                </tbody>
            </table>
            <h4 class="chart-title">Helpful Tips</h4>
            <p class="chart-text">Being a natural fibre, wool has a certain amount of flexibility and size may vary slightly. Our chest width measurements are calculated by measuring across the fullest part of the chest.</p>
            <div class="how-to-measure-container">
                <div class="how-to-measure-image">
                    <img class="sizes" src="{{view url="images/size-chart.png"}}" alt="Measurements" width="420" height="421">
                </div>
                <div class="how-to-measure-content">
                    <h4>How To Measure</h4>
                    <ul class="how-to-measure-list">
                        <li class="measurment">
                            <p class="measure-heading"><strong>CHEST</strong>:</p>
                            <p class="measure-text">Measure across the fullest part of your chest.</p>
                        </li>
                        <li class="measurment">
                            <p class="measure-heading"><strong>WAIST</strong>:</p>
                            <p class="measure-text">Bend to one side to find the natural crease of your waist; measure across this point.</p>
                        </li>
                        <li class="measurment">
                            <p class="measure-heading"><strong>HIPS</strong>:</p>
                            <p class="measure-text">Standing with your feet together, measure around the fullest part.</p>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        EOD;
        $newCmsStaticBlock = [
            'title' => 'Size Chart Popup',
            'identifier' => 'size-chart-content',
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
