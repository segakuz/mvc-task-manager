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
    <h1 class="display-4 mb-5">Вход для администратора</h1>
    <?php if(! $is_admin): ?>
    <form action="/admin/check" method="POST">
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
        <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control" id="login" name="login" value="<?php if($login) echo $login; ?>">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <input type="submit" name="login_submit" class="btn btn-success" value="Войти">
    </form>
    <?php else: ?>
    <p>Вы авторизованы.</p>
    <a href="/admin/logout" class="btn btn-danger">Выйти</a>
    <?php endif; ?>
</main>

<?php include './assets/tpl/layouts/footer.php'; ?>