<?php
class ProjectController
{
  function __construct()
  {
    $this->repo = new Repo();
  }

  public function index()
  {
    $agency_id = $GLOBALS["conn"]["agency"]["id"];

    $GLOBALS["unpublished"] =
      $this
      ->repo
      ->select([
        "p.id AS page_id",
        "p.permalink AS page_permalink",
        "p.uuid AS page_uuid",
        "p.meta_title AS page_meta_title",
        "p.meta_description AS page_meta_description",
        "p.inserted_at AS page_inserted_at",
        "u.name AS user_name",
        "u.role AS user_role",
        "a.name AS attachment_name",
        "a.kind AS attachment_kind",
        "a.title AS attachment_title"
      ])
      ->from("pages p")
      ->join("LEFT", [
        "users u" => "p.user_id = u.id",
        "attachments a" => "a.page_id = p.id"
      ])
      ->where("p.agency_id = {$agency_id} AND a.kind = 'page' AND a.title = 'cover_image' AND p.status = 1")
      ->order_by(["DESC" => "p.id"])
      ->all();

    $GLOBALS["published"] =
      $this
      ->repo
      ->select([
        "p.id AS page_id",
        "p.permalink AS page_permalink",
        "p.uuid AS page_uuid",
        "p.meta_title AS page_meta_title",
        "p.meta_description AS page_meta_description",
        "p.inserted_at AS page_inserted_at",
        "u.name AS user_name",
        "u.role AS user_role",
        "a.name AS attachment_name",
        "a.kind AS attachment_kind",
        "a.title AS attachment_title"
      ])
      ->from("pages p")
      ->join("LEFT", [
        "users u" => "p.user_id = u.id",
        "attachments a" => "a.page_id = p.id"
      ])
      ->where("p.agency_id = {$agency_id} AND a.kind = 'page' AND a.title = 'cover_image' AND p.status = 2")
      ->order_by(["DESC" => "p.id"])
      ->all();

    $count_unpub =
      $this
      ->repo
      ->select_distinct("count(p.id) AS num")
      ->from("pages p")
      ->where("p.agency_id = {$agency_id} AND p.status = 1")
      ->one();

    $count_pub =
      $this
      ->repo
      ->select_distinct("count(p.id) AS num")
      ->from("pages p")
      ->where("p.agency_id = {$agency_id} AND p.status = 2")
      ->one();

    $total = intval($count_unpub["num"]) + intval($count_pub["num"]);

    if ($total != 0) {
      $GLOBALS["statics"] = [
        "total" => $total,
        "percent_pub" => (intval($count_pub["num"]) / $total) * 100,
        "percent_unpub" => (intval($count_unpub["num"]) / $total) * 100
      ];
    } else {
      $GLOBALS["statics"] = [
        "total" => 0,
        "percent_pub" => 0,
        "percent_unpub" => 0
      ];
    }
  }

  public function create()
  {
    #- Validate phone number
    if (!Utils::validate_phone_number($_POST["user"]["phone"])) {
      $_SESSION["popup"] = ["status" => 0, "error" => "Your phone number is not valid."];
      header("location: /project/new");
      exit;
    }

    $agency_id = $GLOBALS["conn"]["agency"]["id"];

    $user = [
      "agency_id" => $agency_id,
      "uuid" => $_POST["user"]["uuid"],
      "username" => RandUsername::generate(),
      "name" => trim($_POST["user"]["name"]),
      "password" => md5(trim($_POST["user"]["password"])),
      "email" => trim(strtolower($_POST["user"]["email"])),
      "phone" => $_POST["user"]["phone"]
    ];

    if ($this->repo->insert("users", $user)) {
      $data_user = $this->repo->get_by("users", ["uuid" => $user["uuid"]]);
    } else {
      $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
      header("location: /project/new");
      exit;
    }

    $page = [
      "agency_id" => $agency_id,
      "user_id" => $data_user["id"],
      "uuid" => $_POST["page"]["uuid"],
      "permalink" => trim(strtolower($_POST["page"]["permalink"])),
      "meta_title" => trim($_POST["page"]["meta_title"]),
      "meta_description" => trim($_POST["page"]["meta_description"])
    ];

    if ($this->repo->insert("pages", $page)) {
      $data_page = $this->repo->get_by("pages", ["uuid" => $page["uuid"]]);
    } else {
      $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
      header("location: /project/new");
      exit;
    }

    $notification = [
      "agency_id" => $agency_id,
      "user_id" => $data_user["id"],
      "page_id" => $data_page["id"],
      "email" => ($_POST["notification"]["email"] == "on") ? 1 : 0,
      "line" => ($_POST["notification"]["line"] == "on") ? 1 : 0
    ];

    if (!$this->repo->insert("notifications", $notification)) {
      $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
      header("location: /project/new");
      exit;
    }

    $favicon = [
      "agency_id" => $agency_id,
      "user_id" => $data_user["id"],
      "page_id" => $data_page["id"],
      "name" => basename($_FILES["attachment"]["name"]["favicon"]),
      "kind" => "page",
      "title" => "favicon",
      "type" => FileHandler::mime_content_type($_FILES["attachment"]["tmp_name"]["favicon"]),
      "tmp_name" => $_FILES["attachment"]["tmp_name"]["favicon"]
    ];

    $cover_image = [
      "agency_id" => $agency_id,
      "user_id" => $data_user["id"],
      "page_id" => $data_page["id"],
      "name" => basename($_FILES["attachment"]["name"]["cover_image"]),
      "kind" => "page",
      "title" => "cover_image",
      "type" => FileHandler::mime_content_type($_FILES["attachment"]["tmp_name"]["cover_image"]),
      "tmp_name" => $_FILES["attachment"]["tmp_name"]["cover_image"]
    ];

    if (!$this->repo->insert("attachments", $favicon) || !$this->repo->insert("attachments", $cover_image)) {
      $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
      header("location: /project/new");
      exit;
    } else {
      #- Upload all attachment to drive
      $uploads_dir = "/priv/drive/{$GLOBALS['conn']['agency']['cname']}";
      $files_upload = [$favicon, $cover_image];
      foreach ($files_upload as $file) {
        $tmp_name = $file["tmp_name"];
        $name = "{$file['kind']}-{$file['title']}-{$file['page_id']}-{$file['name']}";
        move_uploaded_file($tmp_name, "{$uploads_dir}/{$name}");
      }
      $_SESSION["popup"] = ["status" => 1, "info" => "Already created your page."];
      header("location: /project");
      exit;
    }
  }
}
