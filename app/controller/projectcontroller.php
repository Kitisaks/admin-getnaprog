<?php
namespace App\Controller;

use App\{Repo,View,Session,Data,Libs}; 

class ProjectController
{
  public function __construct()
  {
    Session::permitted();
    $this->Repo = new Repo();
    $this->View = new View(__CLASS__);
  }

  public function index($conn, $params)
  {
    $agency_id = $conn["agency"]["id"];
        
    $query =
      $this
      ->Repo
      ->select([
        "p.id as p_id",
        "p.permalink as p_permalink",
        "p.uuid as p_uuid",
        "p.status as p_status",
        "p.meta_title as p_meta_title",
        "p.meta_description as p_meta_description",
        "p.inserted_at as p_inserted_at",
        "u.name as u_name",
        "u.role as u_role",
        "a.url as a_url",
        "a.title as a_title"
      ])
      ->from("pages p")
      ->join("left", [
        "users u" => "p.user_id = u.id",
        "attachments a" => "a.page_id = p.id"
      ])
      ->where("p.agency_id = {$agency_id} and a.kind = 'page'")
      ->order_by(["desc" => "p.id"]);

    $pages = $this->View->paginate($params, $query, "pages", 10);


    $attachments = Data\Attachment::attach_many($pages, "favicon");

    $this
      ->View
      ->assign("attachments", $attachments)
      ->assign("pages", $pages)
      ->render("index.html");
  }

  public function show($conn, $params)
  {
    $page =
      $this
      ->Repo
      ->select([
        "p.id as p_id",
        "p.permalink as p_permalink",
        "p.uuid as p_uuid",
        "p.title as p_title",
        "p.content as p_content",
        "p.description as p_description",
        "p.meta_title as p_meta_title",
        "p.meta_keyword as p_meta_keyword",
        "p.meta_description as p_meta_description",
        "p.inserted_at as p_inserted_at",
        "u.id as u_id",
        "u.name as u_name",
        "u.email as u_email",
        "u.phone as u_phone",
        "u.role as u_role",
        "a.kind as a_kind",
        "a.title as a_title",
        "a.url as a_url"
      ])
      ->from("pages p")
      ->join("left", [
        "users u" => "p.user_id = u.id",
        "attachments a" => "a.page_id = p.id"
      ])
      ->where("p.agency_id = {$conn['agency']['id']} and p.uuid = '{$params['uuid']}'")
      ->one();

    $cover_image = Data\Attachment::attach($page, "cover_image");
    $favicon = Data\Attachment::attach($page, "favicon");

    $this
      ->View
      ->assign("page", $page)
      ->assign("cover_image", $cover_image)
      ->assign("favicon", $favicon)
      ->render("show.html");
  }

  public function new()
  {
    $this
      ->View
      ->render("new.html");
  }

  public function create($conn, $params)
  {
    #- Validate phone number
    if (!Libs\Utils::validate_phone_number($params["user"]["phone"])) {
      $this
        ->View
        ->put_flash(false, "Your phone number is not valid.")
        ->redirect("/project/new");
    }

    $agency_id = $conn["agency"]["id"];

    $user = [
      "agency_id" => $agency_id,
      "uuid" => $params["user"]["uuid"],
      "username" => Libs\RandUsername::generate(),
      "name" => trim($params["user"]["name"]),
      "password" => md5(trim($params["user"]["password"])),
      "email" => strtolower(trim($params["user"]["email"])),
      "phone" => $params["user"]["phone"]
    ];

    if ($this->Repo->insert("users", $user)) {
      $data_user = $this->Repo->get_by("users", ["uuid" => $user['uuid']]);
    } else {
      $this
        ->View
        ->put_flash(false, "Somethings went wrong.")
        ->redirect("/project/new");
    }

    $page = [
      "agency_id" => $agency_id,
      "user_id" => $data_user["id"],
      "uuid" => $params["page"]["uuid"],
      "permalink" => strtolower(trim($params["page"]["permalink"])),
      "meta_title" => trim($params["page"]["meta_title"]),
      "meta_description" => trim($params["page"]["meta_description"])
    ];

    if ($this->Repo->insert("pages", $page)) {
      $data_page = $this->Repo->get_by("pages", ["uuid" => $page['uuid']]);
    } else {
      $this
        ->View
        ->put_flash(false, "Somethings went wrong.")
        ->redirect("/project/new");
    }

    $notification = [
      "agency_id" => $agency_id,
      "user_id" => $data_user["id"],
      "page_id" => $data_page["id"]
    ];

    if (isset($params["notification"]["line"]))
      array_merge(
        $notification,
        ["line" => ($params["notification"]["line"] == "on") ? 1 : 0]
      );

    if (isset($_POST["notification"]["email"]))
      array_merge(
        $notification,
        ["email" => ($params["notification"]["email"] == "on") ? 1 : 0]
      );

    if (!$this->Repo->insert("notifications", $notification)) {
      $this
        ->View
        ->put_flash(false, "Somethings went wrong.")
        ->redirect("/project/new");
    }

    if ($_FILES["attachment"]["name"]["favicon"] != "") {
      $favicon = [
        "agency_id" => $agency_id,
        "page_id" => $data_page["id"],
        "name" => basename($_FILES["attachment"]["name"]["favicon"]),
        "kind" => "page",
        "obj" => "favicon",
        "type" => Libs\FileHandler::mime_content_type($_FILES["attachment"]["tmp_name"]["favicon"])
      ];

      $url = Data\Attachment::upload_file_ftp($favicon);

      $favicon = array_push($favicon, ["url" => $url]);

      if (!$this->Repo->insert("attachments", $favicon)) {
        $this
          ->View
          ->put_flash(false, "Somethings went wrong.")
          ->redirect("/project/new");
      }

      $favicon =
        array_merge(
          $favicon,
          ["tmp_name" => $_FILES["attachment"]["tmp_name"]["favicon"]]
        );

      
    }

    if ($_FILES["attachment"]["name"]["cover_image"] != "") {
      $cover_image = [
        "agency_id" => $agency_id,
        "page_id" => $data_page["id"],
        "name" => basename($_FILES["attachment"]["name"]["cover_image"]),
        "kind" => "page",
        "title" => "cover_image",
        "type" => Libs\FileHandler::mime_content_type($_FILES["attachment"]["tmp_name"]["cover_image"])
      ];

      if (!$this->Repo->insert("attachments", $cover_image)) {
        $this
          ->View
          ->put_flash(false, "Somethings went wrong.")
          ->redirect("/project/new");
      }

      $cover_image =
        array_merge(
          $cover_image,
          ["tmp_name" => $_FILES["attachment"]["tmp_name"]["cover_image"]]
        );

      Data\Attachment::upload_file_ftp($cover_image);
    }

    $this
      ->View
      ->put_flash(true, "Already created your page.")
      ->redirect("/project/{$data_page['uuid']}");
  }
}
