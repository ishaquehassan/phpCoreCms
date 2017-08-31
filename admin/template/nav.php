<nav class="main-nav">
    <h3 class="mt0 mb0 nav-title">Admin Controls</h3>
    <ul>
        <?php foreach ($configs["nav"] as $navItem){ ?>
            <?php if(isset($navItem['visible']) and $navItem['visible']){ ?>
            <li><a href="<?=$navItem['url']?>">
                    <i class="<?=$navItem['icon']?>" aria-hidden="true"></i>
                    <span><?=$navItem['title']?></span>
                </a>
            </li>
            <?php } ?>
        <?php } ?>
        <li class="visible-xs">
            <a href="base/logout.php" style="background: #eaeaea;">
                <i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>