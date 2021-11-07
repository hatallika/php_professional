
<div class="auth">
    <?php if ($auth): ?>
        Добро пожаловать, <?=$username?>! <a href="/auth/logout">[Выход]</a>
    <?php else:?>
        <?=$message_auth?>
        Пожалуйста, авторизуйтесь
        <form method="post" action='/auth/login'>
            <p><input type="text" name="login" value="admin"></p>
            <p><input type="password" name="pass" value="123"></p>
            Save? <input type="checkbox" name="save">
            <p><input type="submit" name="ok"></p>
        </form>
    <?php endif;?>
    <br>
</div>