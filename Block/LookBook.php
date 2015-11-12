<?php

namespace MagentoEse\LookBook\Block;

use Magento\Catalog\Block\Category\View as CategoryView;
use Magento\Catalog\Helper\Category as CategoryHelper;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\DB\Select;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template\Context;

class LookBook extends CategoryView
{
    const MEDIA_DIR_BASE = 'lookbook';

    protected $lookCollection;

    protected $sortedPromos;

    protected $productCollectionFactory;

    public function __construct(
        Context $context,
        Resolver $layerResolver,
        Registry $registry,
        CategoryHelper $categoryHelper,
        ProductCollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $layerResolver, $registry, $categoryHelper, $data);
    }

    public function _construct()
    {
        if (!$this->hasTemplate()) {
            $this->setTemplate('MagentoEse_LookBook::lookbook.phtml');
        }
    }

    /**
     * Returns collection of children categories used to display looks
     *
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getLookCollection()
    {
        if ($this->lookCollection === null) {
            $category = $this->getCurrentCategory();

            /* @var $collection \Magento\Catalog\Model\ResourceModel\Category\Collection */
            $collection = $category->getCollection();
            $collection->addAttributeToSelect('url_key')
                ->addAttributeToSelect('name')
                ->addAttributeToSelect('description')
                ->addAttributeToSelect('look_book_main_image')
                ->addAttributeToSelect('all_children')
                ->addAttributeToSelect('is_anchor')
                ->addAttributeToFilter('is_active', 1)
                ->addIdFilter($category->getChildren())
                ->setOrder('position', Select::SQL_ASC)
                ->joinUrlRewrite();

            $this->lookCollection = $collection;
        }
        return $this->lookCollection;
    }

    /**
     * Returns sorted array of products belonging to given look with a position of 1 or greater
     *
     * @param Category $category
     * @return array
     */
    public function getSortedPromosByLook(Category $category)
    {
        if ($this->sortedPromos === null) {
            $lookCollection = $this->getLookCollection();
            $loadedProductsFilter = [];

            /** @var Category $look */
            foreach ($lookCollection as $look) {
                $loadedProductsFilter = array_merge($loadedProductsFilter, array_keys($look->getProductsPosition()));
            }

            $productCollection = $this->productCollectionFactory->create()
                ->setStoreId($category->getStoreId())
                ->addAttributeToSelect('look_book_image')
                ->addAttributeToSelect('look_book_subtitle')
                ->addAttributeToSelect('look_book_headline')
                ->addIdFilter($loadedProductsFilter);

            foreach ($lookCollection as $look) {
                $this->sortedPromos[$look->getId()] = [];
                $position = $look->getProductsPosition();

                foreach ($productCollection as $product) {
                    if (isset($position[$product->getId()]) && isset($position[$product->getId()])) {
                        $this->sortedPromos[$look->getId()][$position[$product->getId()]] = $product;
                    }
                }
                ksort($this->sortedPromos[$look->getId()]);
            }
        }
        return isset($this->sortedPromos[$category->getId()]) ? $this->sortedPromos[$category->getId()] : [];
    }

    /**
     * Returns data load URL for look view modal
     *
     * @param Category $category
     * @return string
     */
    public function getLookViewUrl(Category $category)
    {
        return $this->getUrl('lookbook/look/view', ['id' => $category->getId()]);
    }

    /**
     * Returns URL to a carousel image using file name passed as final portion of URI
     *
     * @param $file
     * @return string
     */
    public function getCarouselMediaUrl($file)
    {
        return $this->getBaseMediaUrl() . 'carousel/' . $file;
    }

    /**
     * Returns URL to a promo image using file name passed as final portion of URI
     *
     * @param $file
     * @return string
     */
    public function getPromoMediaUrl($file)
    {
        return $this->getBaseMediaUrl() . 'promo/' . $file;
    }

    /**
     * Returns base URL for lookbook media
     *
     * @return string
     */
    public function getBaseMediaUrl()
    {
        $baseMediaUrl = $this->getCurrentCategory()->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $baseMediaUrl . self::MEDIA_DIR_BASE . '/';
    }
}
