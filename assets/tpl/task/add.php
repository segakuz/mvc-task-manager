<?php include './assets/tpl/layouts/header.php'; ?>
<header>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <span class="navbar-text">Приложение-задачник</span>
            <a href="/" class="btn btn-outline-info">К списку задач</a>
        </div>
    </nav>
</header>
<main class="container py-5">
    <h1 class="display-4 mb-5">Создание новой задачи</h1>
    <form action="" method="POST">
        <?php if($errors): ?>
        <div class="alert alert-danger" role="alert">
            <p class="alert-heading lead font-weight-bold">Ошибка валидации</p>
            <?php 
            foreach($errors as $error)
            {
                echo "<p>{$error}</p>";
            }
            ?>
        </div>
        <?php endif; ?>
        <?php if($success): ?>
        <div class="alert alert-success" role="alert">
            <p class="alert-heading lead font-weight-bold">Спасибо!</p>
            <p>Задача успешно добавлена.</p>
        </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="name">Имя пользователя</label>
            <input type="text" class="form-control" id="name" name="user_name" value="<?php if($name) echo $name; ?>">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php if($email) echo $email; ?>">
        </div>
        <div class="form-group">
            <label for="text">Текст задачи</label>
            <textarea class="form-control" id="text" rows="3" name="text"><?php if($text) echo $text; ?></textarea>
        </div>
        <input type="submit" name="submit" class="btn btn-success" value="Создать задачу">
    </form>
</main>

<?php include './assets/tpl/layouts/footer.php'; ?>