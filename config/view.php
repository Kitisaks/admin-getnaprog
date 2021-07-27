<?php
class View{

  function __construct(){
    
  }

  public function render($main, $page, $no_layout = false){
    #- no layout set ($no_layout = 1)
    switch ($no_layout) {
      case true:
        require "../view/$main/$page.html.php";
        break;
      
      case false:
        require "../view/layout/header.html.php";
        require "../view/$main/$page.html.php";
        require "../view/layout/footer.html.php";
        break;
    }

  }
}