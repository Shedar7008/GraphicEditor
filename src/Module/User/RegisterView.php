<?php

namespace Shop\Module\User;


use Shop\Core\View;

class RegisterView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'register';
    }
}