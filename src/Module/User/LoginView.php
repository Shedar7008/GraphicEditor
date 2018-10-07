<?php

namespace Shop\Module\User;


use Shop\Core\View;

class LoginView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'login';
    }
}