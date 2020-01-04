<?php

class SiteController
{
    /**
     * Shows main page
     * 
     * @param int $page
     * @param string $sortBy
     * @param string $order
     * 
     * @return bool
     */
    public function indexAction(int $page=1, string $sortBy='id', string $order='asc')
    {
        $page = test_input($page);
        $sortBy = test_input($sortBy);
        $order = test_input($order);
        $taskModel = new Task();
        $tasksList = $taskModel->getPageTasks($page, $sortBy, $order);
        $tasksCount = $taskModel->getTasksCount();
        $sort = new Sort($page, $sortBy, $order);
        $auth = App::getApp()->getRequest()->getAuth();
        $is_admin = $auth->isAuth();
        $pagination = new Pagination($tasksCount, $page, 3, $sortBy, $order);
        $data = compact('tasksList', 'is_admin', 'sort', 'pagination');
        $view = new View(DEFAULT_ACTION . '.php');
        $view->render($data);
        return true;
    }
}
