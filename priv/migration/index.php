<div>
  <h2 style="text-align: center">============CREATE NEW DATABASE!============</h2>

  <h4 style="text-align: center;">
    <?php
    #- Create databases
    require_once __DIR__ . "/migration.php";
    require_once __DIR__ . "/database/getprog_db.php";

    #- Create tables
    require_once __DIR__ . "/table/agencies.php";
    require_once __DIR__ . "/table/users.php";
    require_once __DIR__ . "/table/pages.php";
    require_once __DIR__ . "/table/posts.php";
    //==== put more if want .. ====//
    ?>
  </h4>

  <h2 style="text-align: center">============FINISHED!============</h2>
</div>