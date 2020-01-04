<?php include './assets/tpl/layouts/header.php'; ?>

<header>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <span class="navbar-text">Приложение-задачник</span>
            <a href="/" class="btn btn-outline-info" type="button">К списку задач</a>
        </div>
    </nav>
</header>
<main class="container py-5">
    <h1 class="display-4 mb-5">Редактирование задачи</h1>
    <form action="/task/edit/<?= $task['id']; ?>" method="POST">
        <?php if($errors): ?>
        <div class="alert alert-danger" role="alert">
            <p class="alert-heading lead font-weight-bold">Ошибка сохранения</p>
            <p><?= $errors;?></p>
        </div>
        <?php else: ?>
        <?php if($success): ?>
        <div class="alert alert-success" role="alert">
            <p class="alert-heading lead font-weight-bold">Спасибо!</p>
            <p>Задача отредактирована.</p>
        </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="name">Имя пользователя</label>
            <input type="text" class="form-control" id="name" readonly value="<?= $task['user_name'] ?>">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" readonly value="<?= $task['email'] ?>">
        </div>
        <div class="form-group">
            <label for="text">Текст задачи</label>
            <textarea class="form-control" id="text" rows="3" name="text"><?= $task['text'] ?></textarea>
        </div>
        <div class="custom-control custom-checkbox my-1 mr-sm-2">
            <input type="checkbox" class="custom-control-input" id="status" name="status" <?php if($task['status']) echo 'checked'; ?>>
            <label class="custom-control-label" for="status">Выполнено</label>
        </div>
        <input type="submit" name="edit_submit" class="btn btn-success mt-4" value="Сохранить задачу">
    </form>
    <?php endif; ?>
</main>

<?php include './assets/tpl/layouts/footer.php'; ?>