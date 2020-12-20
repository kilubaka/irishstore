<?php

namespace Kravchuk\ModuleAdder\Block;

class CustomLink extends \Magento\Framework\View\Element\Html\Link
{
    /**
     * Render block HTML.
     *
     * @return string
     */

    protected function _toHtml()
    {
        if (false != $this->getTemplate()) {
            return parent::_toHtml();
        }
        return '<li class="header-text">
            <a class="header-text--link" title="Delivery Information" ' . $this->getLinkAttributes() . ' >
            ' . $this->escapeHtml($this->getLabel()) . '
            </a>
        </li>';
    }
}
