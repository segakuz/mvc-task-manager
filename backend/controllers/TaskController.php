<?php

class TaskController
{

    /**
     * Adds new task
     * 
     * @return bool
     */
    public function addAction()
    {
        $input = App::getApp()->getRequest()->getInput();
        $name = false;
        $email = false;
        $text = false;
        $errors = false;
        if($input->get('submit'))
        {
            if(empty($input->get('user_name')) || empty($input->get('text')) || empty($input->get('email')))
            {
                $errors[] = 'Все поля обязательны для заполнения';
                $input->clear('submit');
            }
            if( !empty($input->get('email')))
            {
                $email = test_input($input->get('email'));
                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $errors[] = "Email невалиден";
                    $input->clear('submit');
                }
            }
            $name = test_input($input->get('user_name'));
            $text = test_input($input->get('text'));
            $data = compact('name', 'email', 'text');
            if(empty($errors))
            {
                $taskModel = new Task();
                $result = $taskModel->write($name, $email, $text);
                $data = [];
                $data['success'] = $result;
                $input->clear('user_name');
                $input->clear('email');
                $input->clear('text');
                $input->clear('submit');
            }
            else
            {
                $data['errors'] = $errors;
            }
            
        }
        $view = new View('task/add.php');
        $view->render($data);
        return true;
    }

    /**
     * Edits existing task
     * 
     * @param int $id
     * 
     * @return bool
     */
    public function editAction(int $id)
    {
        $auth = App::getApp()->getRequest()->getAuth();
        $is_admin = $auth->isAuth();
        $input = App::getApp()->getRequest()->getInput();
        $newText = false;
        $status = false;
        $id = intval(test_input($id));
        if(!$is_admin)
        {
            $data['errors'] = 'Необходима авторизация';
        }
        else
        {
            $taskModel = new Task();
            $taskById = $taskModel->getTaskById($id);
            $oldText = $taskById['text'];
            $oldStatus = intval($taskById['status']);
            $data['task'] = $taskById;
            if($input->get('edit_submit'))
            {
                $newText = test_input($input->get('text'));
                $status = test_input($input->get('status'));
                $status = ($status == 'on')? 1 : 0 ;
                if(mb_strcasecmp($oldText, $newText) !== 0)
                {
                    $modified = 1;
                }
                else
                {
                    $modified = 0;
                }
                if($modified || $status != $oldStatus)
                {
                    $result = $taskModel->updateTask($id, $newText, $status, $modified);
                    if($result)
                    {
                        $data['success'] = true;
                        $data['task']['text'] = $newText;
                        $data['task']['status'] = $status;
                    } 
                }
            }
        }
        $view = new View('task/edit.php');
        $view->render($data);
        return true;
    }
}
