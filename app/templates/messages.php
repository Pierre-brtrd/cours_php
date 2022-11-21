<?php if (isset($_SESSION['message']['error'])) : ?>
    <div class="alert alert-danger">
        <i class="bi bi-patch-exclamation-fill"></i>
        <?php
        echo $_SESSION['message']['error'];
        unset($_SESSION['message']['error']);
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['message']['success'])) : ?>
    <div class="alert alert-success">
        <i class="bi bi-patch-check-fill"></i>
        <?php
        echo $_SESSION['message']['success'];
        unset($_SESSION['message']['success']);
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['message']['info'])) : ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle-fill"></i>
        <?php
        echo $_SESSION['message']['info'];
        unset($_SESSION['message']['info']);
        ?>
    </div>
<?php endif; ?>