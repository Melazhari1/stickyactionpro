<?php

    $bgcolor = get_option('stickyactionpro_bgcolor');
    $txtcolor = get_option('stickyactionpro_txtcolor');
    $size = get_option('stickyactionpro_size');
    $blocks = get_option('stickyactionpro_blocks');

?>
<style>
    :root {
    --bg-color: <?= $bgcolor ?>;
    --txt-color: <?= $txtcolor ?>;
    --size: <?= $size ?>px;
}


.link-item-stickyactionpro{
    background-color: var(--bg-color) !important;
    color: var(--txt-color) !important;
    font-size: var(--size) !important;
}


.nav-stickyactionpro {
    position: fixed;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9999;
}

.nav-stickyactionpro .nav-content {
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    background-color: #fff;
    overflow-x: auto;
    width: 120px;
    display: flex;
    flex-direction: column;
    align-items: center;
    max-height: 300px;
    line-height: 25px;
    background-color: var(--bg-color) !important;
    color: var(--txt-color) !important;
    border:1px solid;
    overflow: hidden;
}

.nav-stickyactionpro .nav-content a {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    padding: 10px 0;
    white-space: normal;
    font-family: sans-serif;
    text-decoration: none;
    -webkit-tap-highlight-color: transparent;
    transition: background-color 0.1s ease-in-out;
    text-align: center;
    line-height:29px;
}

.nav-stickyactionpro .nav-content a:not(:last-child) {
    border-bottom: 1px solid;
}

@media (max-width: 600px) {
    .nav-stickyactionpro {
        position: fixed;
        right: 0;
        bottom: 0;
        width: 100%;
        top: initial;
        transform: none;
    }

    .nav-stickyactionpro .nav-content a:not(:last-child) {
        border-right: 1px solid;
        border-bottom: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .nav-stickyactionpro .nav-content {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: stretch;
        max-width: 100%;
    }
}

</style>

<nav class="nav-stickyactionpro ">
    <div class="nav-content link-item">
        <?php foreach ($blocks as $key => $value):?>
            <a href="<?= $value['link'] ?> " class="link-item-stickyactionpro">
                <i class="<?= $value['icon'] ?> fa-2x"></i>
                <span><?= $value['title'] ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</nav>