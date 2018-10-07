<?php

namespace Shop\Module\User;


use Shop\Core\View;

class AuthorizedView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'authorized';
    }
}