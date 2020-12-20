<?php

namespace Kravchuk\ModuleAdder\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Session as CatalogSession;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class newLabelViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    /**
     * @var TimezoneInterface
     */
    protected $localeDate;
    /**
     * Current Product
     *
     * @var ProductInterface
     */
    private $currentProduct;
    /**
     * @var CatalogSession
     */
    protected $catalogSession;
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;
    protected $_registry;

    public function __construct(
        TimezoneInterface $localeDate,
        CatalogSession $catalogSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Registry $registry
    ) {
        $this->localeDate = $localeDate;
        $this->catalogSession = $catalogSession;
        $this->productRepository = $productRepository;
        $this->_registry = $registry;
    }

    public function getProduct()
    {
        return $this->_registry->registry('current_product');
    }

    public function isProductNew()
    {
        $product = $this->getProduct();
        $newsFromDate = $product->getNewsFromDate();
        $newsToDate = $product->getNewsToDate();
        if (!$newsFromDate && !$newsToDate) {
            return false;
        }

        return $this->localeDate->isScopeDateInInterval(
            $product->getStore(),
            $newsFromDate,
            $newsToDate
        );
    }
}
