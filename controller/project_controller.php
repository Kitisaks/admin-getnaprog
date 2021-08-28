<?php
class ProjectController
{
  function __construct()
  {
    $this->repo = new Repo();
  }

  public function index()
  {
    $agency_id = $_SESSION["conn"]["agency"]["id"];

    $GLOBALS["unpublished"] =
      $this
      ->repo
      ->select([
        "p.id as page_id",
        "p.permalink as page_permalink",
        "p.uuid as page_uuid",
        "p.meta_title as page_meta_title",
        "p.meta_description as page_meta_description",
        "p.inserted_at as page_inserted_at",
        "u.name as user_name",
        "u.role as user_role",
        "a.name as attachment_name",
        "a.kind as attachment_kind",
        "a.title as attachment_title"
      ])
      ->from("pages p")
      ->join("left", [
        "users u" => "p.user_id = u.id",
        "attachments a" => "a.page_id = p.id"
      ])
      ->where("p.agency_id = {$agency_id} and a.kind = 'page' and a.title = 'cover_image' and p.status = 1")
      ->order_by(["desc" => "p.id"])
      ->limit(8)
      ->all();

    $GLOBALS["published"] =
      $this
      ->repo
      ->select([
        "p.id as page_id",
        "p.permalink as page_permalink",
        "p.uuid as page_uuid",
        "p.meta_title as page_meta_title",
        "p.meta_description as page_meta_description",
        "p.inserted_at as page_inserted_at",
        "u.name as user_name",
        "u.role as user_role",
        "a.name as attachment_name",
        "a.kind as attachment_kind",
        "a.title as attachment_title"
      ])
      ->from("pages p")
      ->join("left", [
        "users u" => "p.user_id = u.id",
        "attachments a" => "a.page_id = p.id"
      ])
      ->where("p.agency_id = {$agency_id} and a.kind = 'page' and a.title = 'cover_image' and p.status = 2")
      ->order_by(["desc" => "p.id"])
      ->limit(8)
      ->all();

    $count_unpub =
      $this
      ->repo
      ->select("count(p.id) as num", "distinct")
      ->from("pages p")
      ->where("p.agency_id = {$agency_id} and p.status = 1")
      ->one();

    $count_pub =
      $this
      ->repo
      ->select("count(p.id) as num", "distinct")
      ->from("pages p")
      ->where("p.agency_id = {$agency_id} and p.status = 2")
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

    $agency_id = $_SESSION["conn"]["agency"]["id"];

    $user = [
      "agency_id" => $agency_id,
      "uuid" => $_POST["user"]["uuid"],
      "username" => RandUsername::generate(),
      "name" => trim($_POST["user"]["name"]),
      "password" => md5(trim($_POST["user"]["password"])),
      "email" => strtolower(trim($_POST["user"]["email"])),
      "phone" => $_POST["user"]["phone"]
    ];

    if ($this->repo->insert("users", $user)) {
      $data_user = $this->repo->get_by("users", "uuid='{$user['uuid']}'");
    } else {
      $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
      header("location: /project/new");
      exit;
    }

    $page = [
      "agency_id" => $agency_id,
      "user_id" => $data_user["id"],
      "uuid" => $_POST["page"]["uuid"],
      "permalink" => strtolower(trim($_POST["page"]["permalink"])),
      "meta_title" => trim($_POST["page"]["meta_title"]),
      "meta_description" => trim($_POST["page"]["meta_description"])
    ];

    if ($this->repo->insert("pages", $page)) {
      $data_page = $this->repo->get_by("pages", "uuid='{$page['uuid']}'");
    } else {
      $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
      header("location: /project/new");
      exit;
    }

    $notification = [
      "agency_id" => $agency_id,
      "user_id" => $data_user["id"],
      "page_id" => $data_page["id"]
    ];

    if (isset($_POST["notification"]["line"]))
      array_merge(
        $notification,
        ["line" => ($_POST["notification"]["line"] == "on") ? 1 : 0]
      );

    if (isset($_POST["notification"]["email"]))
      array_merge(
        $notification,
        ["email" => ($_POST["notification"]["email"] == "on") ? 1 : 0]
      );

    if (!$this->repo->insert("notifications", $notification)) {
      $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
      header("location: /project/new");
      exit;
    }

    if ($_FILES["attachment"]["name"]["favicon"] != "") {
      $favicon = [
        "agency_id" => $agency_id,
        "page_id" => $data_page["id"],
        "name" => basename($_FILES["attachment"]["name"]["favicon"]),
        "kind" => "page",
        "title" => "favicon",
        "type" => FileHandler::mime_content_type($_FILES["attachment"]["tmp_name"]["favicon"])
      ];

      if (!$this->repo->insert("attachments", $favicon)) {
        $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
        header("location: /project/new");
        exit;
      }

      $favicon =
        array_merge(
          $favicon,
          ["tmp_name" => $_FILES["attachment"]["tmp_name"]["favicon"]]
        );

      Utils::upload_file_ftp($favicon);
    }

    if ($_FILES["attachment"]["name"]["cover_image"] != "") {
      $cover_image = [
        "agency_id" => $agency_id,
        "page_id" => $data_page["id"],
        "name" => basename($_FILES["attachment"]["name"]["cover_image"]),
        "kind" => "page",
        "title" => "cover_image",
        "type" => FileHandler::mime_content_type($_FILES["attachment"]["tmp_name"]["cover_image"])
      ];

      if (!$this->repo->insert("attachments", $cover_image)) {
        $_SESSION["popup"] = ["status" => 0, "error" => "Somethings went wrong."];
        header("location: /project/new");
        exit;
      }

      $cover_image =
        array_merge(
          $cover_image,
          ["tmp_name" => $_FILES["attachment"]["tmp_name"]["cover_image"]]
        );

      Utils::upload_file_ftp($cover_image);
    }

    $_SESSION["popup"] = ["status" => 1, "info" => "Already created your page."];
    header("location: /project");
    exit;
  }
}
