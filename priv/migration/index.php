<div>
  <h2 style="text-align: center">============CREATE NEW DATABASE!============</h2>

  <h4 style="text-align: center;">
    <?php
    #- Create databases
    require_once "./migration.php";
    require_once "./database/getprog_db.php";

    #- Create tables
    require_once "./table/agencies.php";
    require_once "./table/users.php";
    require_once "./table/pages.php";
    require_once "./table/posts.php";
    //==== put more if want .. ====//
    ?>
  </h4>

  <h2 style="text-align: center">============FINISHED!============</h2>
</div>