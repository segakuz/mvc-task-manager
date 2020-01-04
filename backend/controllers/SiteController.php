<?php

class SiteController
{
    public function indexAction()
    {

        $view = new View(DEFAULT_ACTION . '.php');
        $view->render();
        return true;
    }
}