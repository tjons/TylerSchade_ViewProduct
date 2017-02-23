<?php

namespace TylerSchade\ViewProduct\Block\Adminhtml\Product\Edit\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Store\Model\Store;

class View extends Generic
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var UrlInterface
     */
    private $frontUrlModel;

    /**
     * @var Store
     */
    private $store;

    public function __construct(RequestInterface $request, Context $context, Registry $registry, UrlInterface $frontUrlModel, Store $store)
    {
        $this->request = $request;
        $this->frontUrlModel = $frontUrlModel;
        $this->store = $store;

        parent::__construct($context, $registry);
    }

    public function getButtonData()
    {
        if ($this->isPageEdit()) {
            return [
                'label' => __('View on Frontend'),
                'class' => 'save primary',
                'on_click' => sprintf("window.open('%s');",
                    $this->getUrl($this->getProductUrl($this->getStoreCodeFromId()))
                )
            ];
        } else {
            return [];
        }
    }

    public function isPageEdit(): bool
    {
        return $this->request->getActionName() == 'edit';
    }

    private function getProductUrl($storeCode = 'default'): string
    {
        $routeParams = ['_nosid' => true, '_query' => ['___store' => $storeCode]];

        return (string)$this->frontUrlModel->getUrl("{$this->getProduct()->getUrlKey()}.html", $routeParams);
    }

    private function getCurrentStore(): int
    {
        return (int)$this->request->getParam('store');
    }

    private function getStoreCodeFromId(): string
    {
        return (string)$this->store->load($this->getCurrentStore())->getCode();
    }
}