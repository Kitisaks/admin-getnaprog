<?php

namespace App\Controller;

use 
  App\Repo, 
  App\View, 
  App\Session;

class DesignController
{
  function __construct()
  {
    Session::permitted();
    $this->Repo = new Repo();
    $this->View = new View(__CLASS__);
  }

  public function index($conn, $params)
  {
    if (isset($params["q"]) && !empty($params["q"])) {
      $page =
        $this
        ->Repo
        ->from("pages")
        ->where("id like '%{$params['q']}%' or permalink like '%{$params['q']}%' or title like '%{$params['q']}%'")
        ->limit(1)
        ->one();

      if (!$page || is_null($page)) {
        $query = null;
      } else {
        $query =
          $this
          ->Repo
          ->select([
            "t.id as t_id",
            "t.title as t_title",
            "t.inserted_at as t_inserted_at",
            "p.title as p_title",
            "p.permalink as p_permalink",
            "u.name as u_name",
            "u.email as u_email",
            "u.phone as u_phone"
          ])
          ->from("templates t")
          ->join("left", [
            "pages p" => "p.id = t.page_id",
            "users u" => "u.id = t.user_id"
          ])
          ->where("t.agency_id = {$conn['agency']['id']} and t.page_id = {$page['id']}")
          ->order_by(["asc" => "t.title"]);
          
        $this
        ->View
        ->assign("page",$page);
      }
    } else {
      $query =
        $this
        ->Repo
        ->select([
          "t.id as t_id",
          "t.title as t_title",
          "t.inserted_at as t_inserted_at",
          "p.title as p_title",
          "p.permalink as p_permalink",
          "u.name as u_name",
          "u.email as u_email",
          "u.phone as u_phone"
        ])
        ->from("templates t")
        ->join("left", [
          "pages p" => "p.id = t.page_id",
          "users u" => "u.id = t.user_id"
        ])
        ->where("t.agency_id = {$conn['agency']['id']}")
        ->order_by(["desc" => "t.id"]);
    }

    $templates = $this->View->paginate($params, $query, "templates", 10);

    $pages =
      $this
      ->Repo
      ->from("pages")
      ->where("agency_id = {$conn['agency']['id']}")
      ->order_by(["asc" => "title"])
      ->all();

    $this
      ->View
      ->assign("templates", $templates)
      ->assign("pages", $pages)
      ->render("index.html");
  }

  public function show($conn, $params)
  {
    $template =
      $this
      ->Repo
      ->select([
        "t.id as t_id",
        "t.title as t_title",
        "t.content as t_content",
        "t.inserted_at as t_inserted_at",
        "p.title as p_title",
        "p.permalink as p_permalink",
        "u.id as u_id",
        "u.name as u_name",
        "u.email as u_email",
        "u.phone as u_phone"
      ])
      ->from("templates t")
      ->join("left", [
        "pages p" => "p.id = t.page_id",
        "users u" => "u.id = t.user_id"
      ])
      ->where("t.agency_id = {$conn['agency']['id']} and t.id = {$params['id']}")
      ->one();

    $this
      ->View
      ->assign("template", $template)
      ->render("show.html");
  }

  public function update($conn, $params)
  {
    $update =
      $this
      ->Repo
      ->update("templates", $params["id"], ["content" => $params["content"]]);

    if ($update)
      $this
        ->View
        ->return("json", ["status" => true, "info" => "Already updated the template"]);
    else
      $this
        ->View
        ->return("json", ["status" => false, "info" => "Cannot update the template"]);
  }

  public function delete($conn, $params)
  {
    if ($this->Repo->delete("templates", (int)$params["id"])) {
      $this
        ->View
        ->put_flash(true, "Your post was deleted!")
        ->return("json", ["url" => "/design"]);
    } else {
      $this
        ->View
        ->put_flash(false, "Your request was not allowed!")
        ->return("json", ["url" => "/design/{$params['id']}"]);
    }
  }
}
