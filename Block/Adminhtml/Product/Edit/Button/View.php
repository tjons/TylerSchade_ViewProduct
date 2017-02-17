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
        ];
    }

}