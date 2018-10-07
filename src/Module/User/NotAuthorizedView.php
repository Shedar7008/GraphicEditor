<?php

namespace Shop\Module\User;


use Shop\Core\View;

class NotAuthorizedView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'not_authorized';
    }
}