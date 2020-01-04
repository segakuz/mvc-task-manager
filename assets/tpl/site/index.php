<?php include './assets/tpl/layouts/header.php'; ?>

<header>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <span class="navbar-text">Приложение-задачник</span>
            <?php if($is_admin): ?>
            <a href="/admin/logout" class="btn btn-outline-danger" type="button">Выйти</a>
            <?php else: ?>
            <a href="/admin/login" class="btn btn-outline-secondary" type="button">Авторизация</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<main class="container py-5">
    <h1 class="display-4 d-inline-block mr-5">Список задач</h1>
    <a href="/task/add" class="btn btn-primary">Создать новую</a>
    <div class="table-responsive my-5">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">
                        <?= $sort->getSortButton('user_name', 'Имя'); ?>
                    </th>
                    <th scope="col">
                        <?= $sort->getSortButton('email', 'E-mail'); ?>
                    </th>
                    <th scope="col">Текст задачи</th>
                    <th scope="col">
                        <?= $sort->getSortButton('status', 'Статус'); ?>
                    </th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($tasksList as $task): ?>
                <tr>
                    <td><?= $task['user_name']; ?></td>
                    <td><?= $task['email']; ?></td>
                    <td>
                        <div class="task-text">
                            <?= $task['text']; ?>
                        </div>
                        <?php if($task['is_modified']): ?>
                        <span class="edited-mark text-warning">Отредактировано администратором</span>
                        <?php endif; ?>
                    </td>
                    <td>
                    <?php if($task['status']): ?>
                        <span class="text-success">Выполнено</span>
                    <?php else: ?>
                        <span>Активно</span>
                    <?php endif; ?>
                    </td>
                    <td>
                        <?php if($is_admin): ?>
                        <a href="/task/edit/<?= $task['id']; ?>" class="btn btn-warning" type="button">Редактировать</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <nav aria-label="Навигация по страницам списка задач">
        <?= $pagination->get(); ?>
    </nav>
</main>

<?php include './assets/tpl/layouts/footer.php'; ?>