<?php

namespace Kravchuk\ModuleAdder\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Helper\Data;
use Magento\Catalog\Model\Session as CatalogSession;
use Magento\Directory\Model\CurrencyFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

class DiscountViewModel extends \Magento\Framework\View\Element\Template
{

    /**
     * @var CatalogSession
     */
    private $catalogSession;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * Current Product
     *
     * @var ProductInterface
     */
    private $currentProduct;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var CurrencyFactory
     */
    protected $currencyFactory;

    /**
     * @param CatalogSession $catalogSession
     * @param ProductRepositoryInterface $productRepository
     * @param StoreManagerInterface $storeManager
     * @param CurrencyFactory $currencyFactory
     */
    public function __construct(
        Context $context,
        CatalogSession $catalogSession,
        ProductRepositoryInterface $productRepository,
        StoreManagerInterface $storeManager,
        CurrencyFactory $currencyFactory,
        array $data = []
    ) {
        $this->catalogSession = $catalogSession;
        $this->productRepository = $productRepository;
        $this->storeManager = $storeManager;
        $this->currencyFactory = $currencyFactory;

        parent::__construct($context, $data);
    }

    /**
     * @return ProductInterface
     * @throws NoSuchEntityException
     */
    public function getProduct():ProductInterface
    {
        if (!isset($this->currentProduct)) {
            $productId = $this->getProductId();

            if ($productId) {
                $this->currentProduct = $this->productRepository->getById($productId);
            }
        }
        return $this->currentProduct;
    }

    /**
     * @return string
     */
    public function getProductId():string
    {
        return $this->catalogSession->getData('last_viewed_product_id');
    }

    /**
     * @return string
     */
    public function calcDiscount()
    {
        return " - save $30.00";
        $product = $this->getProduct();
        $regularPrice = $product->getPriceInfo()->getPrice('regular_price')->getMinRegularAmount()->getValue();
        $finalPrice = $product->getFinalPrice();

        $currencyCode = $this->storeManager->getStore()->getCurrentCurrencyCode();
        $currency = $this->currencyFactory->create()->load($currencyCode);
        $currencySymbol = $currency->getCurrencySymbol();

        $sale = 0;
        if ($regularPrice > $finalPrice) {
            $sale = ($regularPrice - $finalPrice);
        }

        if ($sale > 0) {
            return " - save " . $currencySymbol . number_format((float)$sale, 2, '.', '');
        }
        return "";
    }
}
