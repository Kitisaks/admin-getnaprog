<?php
class View{

  function __construct(){
    
  }

  public function render($main, $page, $no_layout = false){
    #- no layout set ($no_layout = 1)
    switch ($no_layout) {
      case true:
        require "../templates/layout/header.html.php";
        require "../templates/$main/$page.html.php";
        require "../templates/layout/footer.html.php";
        break;
      
      case false:
        require "../templates/layout/header.html.php";
        require "../templates/layout/sidebar_top.html.php";
        require "../templates/$main/$page.html.php";
        require "../templates/layout/sidebar_bot.html.php";
        require "../templates/layout/footer.html.php";
        break;
    }

  }
}