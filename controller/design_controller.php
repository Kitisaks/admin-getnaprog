<?php
class DesignController extends Plug
{
  function __construct()
  {
    parent::__construct();
    Session::permitted();
    $this->view = new View(__CLASS__);
  }

  public function index($conn, $params)
  {
    $query =
      $this
      ->repo
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
      ]);

    if (isset($params["q"]) && !empty($params["q"])) {
      $page_search =
        $this
        ->repo
        ->from("pages")
        ->where("id like '%{$params['q']}%' or permalink like '%{$params['q']}%' or title like '%{$params['q']}%'")
        ->limit(1)
        ->one();

      if (!$page_search || is_null($page_search)) {
        $total_page = null;
        $query = null;
      } else {
        $query =
          $query
          ->where("t.agency_id = {$conn['agency']['id']} and t.page_id = {$page_search['id']}")
          ->order_by(["asc" => "t.title"]);
        $this
          ->view
          ->assign(
            "page",
            $this->repo->get("pages", $page_search['id'])
          );
      }
    } else {
      $query =
        $query
        ->where("t.agency_id = {$conn['agency']['id']}")
        ->order_by(["desc" => "t.id"]);
    }

    $templates = $this->paginate($params, $query, "templates", 2);

    $pages =
      $this
      ->repo
      ->from("pages")
      ->where("agency_id = {$conn['agency']['id']}")
      ->order_by(["asc" => "title"])
      ->all();

    $this
      ->view
      ->assign("templates", $templates)
      ->assign("pages", $pages)
      ->render("index.html");
  }

  public function show($conn, $params)
  {
    $template =
      $this
      ->repo
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
      ->view
      ->assign("template", $template)
      ->render("show.html");
  }

  public function update($conn, $params)
  {
    $update =
      $this
      ->repo
      ->update("templates", $params["id"], ["content" => $params["content"]]);

    if ($update)
      $this
        ->view
        ->return(["status" => true, "info" => "Alredy update"], "json");
    else
      $this
        ->view
        ->return(["status" => false, "info" => "Cannot Update"], "json");
  }
}
