# **School Dev**

## ==== **Deployment** ====
#### 1. Change 'MODE' to 'PRO' in *``` config/config.php ```*
#### 2. Also change some database configurations in that file. 
#### 3. Enjoy :)

## ==== **Structure** ====
```c
|= index.php  --> "1st plug to get _req from client browser"
|= data  --> "data for use in application"
|= controller --> "logicals of web application (e.g, query, filter, statistics)"
|= view  --> "views for all directories"
|= priv  --> "keep all privacy data"
|= config --> "e.g, router, config"
|= assets --> "keep all static items (e.g, js, css)" 
```

## ==== **Directories** ====
```
|__assets
|        |__js
|        |__css
|__controller
|__data
|__priv
|      |__data
|      |__migration
|__template
|__view
```

## ==== Documentories ====
- Docs for css. [tailwindCSS](https://tailwindcss.com/docs)
- Docs for js. [jQuery](https://api.jquery.com/)
- Docs for PHP. [PHP](https://www.php.net/docs.php)

## ==== **Templates** ====
### **Controller**
```php
//== TEMPLATE CONTROLLER ==//
class Template extends Plug{

  function __construct(){
    parent::__construct();
    $this->main = strtolower(get_class($this));
  }
  #- render page you want
  public function index(){
    $this->view->render($this->main,"index");
  }
}
```
### **Token check**
```php
if (!empty($_POST['token'])) {
  if (hash_equals($_SESSION['token'], $_POST['token'])) {
    #- Proceed to process the form data
  } else {
    #- Log this as a warning and keep an eye on these attempts
  }
}
```
```html
 <form>
//...
<input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
//...
</form>
```
### **SQL Repo**
#### *Query by id from records*
```php
  $repo = new Repo();
  $results = $repo->get_by("field", "id"); #- field: string, id: integer
  $results = json_decode($results, true);
  #- fetch to see some field record
  echo $results['id'];
  echo $results['username'];
  echo $results['role'];
  echo $results['email'];
```
#### *Query by custom record from SQl*
```php
  $repo = new Repo();
  $query = "SELECT * FROM users"; #- custom your query
  $results = $repo->all($query);
  $results = json_decode($results, true);
  foreach ($results as $i){
    echo($i["username"]);
  }
``` 









<!-- ### ==== Deployment ====
### 1. Setup for Database
#### *On Windows*
- create datebase and tables with this__ remind that "to use with *Super Privilege* role" ==> run with *Administrator*
```bash
bash -c "sh db_create.sh"
```
#### *On Linux*
```bash
sudo chmod +x db_create.sh
./db_create.sh
``` -->
