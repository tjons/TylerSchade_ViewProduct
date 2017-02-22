<?php

namespace TylerSchade\ViewProduct\Block\Adminhtml\Product\Edit\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class View extends Generic
{
    public function getButtonData()
    {
        return [
            'label' => __('View on Frontend'),
            'class' => 'save primary',
            'on_click' => sprintf("location.href = '%s';",
                $this->getUrl($this->getProduct()->getData('url'))
            ),
            'sort_order' => 5,
            'options' => $this->getOptionsForStore()
        ];
    }

    public function getOptionsForStore()
    {
        return [[
            'id_hard' => 'save_and_new',
            'label' => __('Save & New'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'product_form.product_form',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'back' => 'new'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ]];
    }
}