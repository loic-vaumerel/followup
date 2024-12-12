<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Main</h1>
    <?php generate_toolbar (["Main"], ["Settings"], ["Logout"]); ?>
</div>
