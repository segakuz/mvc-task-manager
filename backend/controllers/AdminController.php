<?php

class AdminController
{
    /**
     * Shows login page
     * 
     * @return bool
     */
    public function loginAction()
    {
        $auth = App::getApp()->getRequest()->getAuth();
        $is_admin = $auth->isAuth();
        $data['is_admin'] = $is_admin;
        $view = new View('admin/login.php');
        $view->render($data);
        return true;
    }

    /**
     * Checks authorization data on login page
     */
    public function checkAction()
    {
        $login = false;
        $password = false;
        $input = App::getApp()->getRequest()->getInput();
        $auth = App::getApp()->getRequest()->getAuth();
        if($input->get('login_submit'))
        {
            $login = test_input($input->get('login'));
            $password = test_input($input->get('password'));
            $data['login'] = $login;
            if(empty($login) || empty($password))
            {
                $errors[] = 'Все поля обязательны для заполнения';
                $input->clear('login_submit');
            }
            else
            {
                $auth->init($login, $password);
                if( $auth->verification() )
                {
                    $data = [];
                    $data['is_admin'] = true;
                }
                else
                {
                    $errors[] = 'Неправильные реквизиты доступа';
                }
            }
            if( !empty($errors) )
            {
                $data['errors'] = $errors;
            }
            $view = new View('admin/login.php');
            $view->render($data);
            return true;
        }
        header("Location: /");
    }

    /**
     * Logs out the admin
     */
    public function logoutAction()
    {
        $auth = App::getApp()->getRequest()->getAuth();
        $auth->logout();
        header("Location: /");
    }
}
