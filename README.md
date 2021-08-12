# **School Dev**

## ==== **Deployment** ====

#### 1. Change 'MODE' to 'PRO' in _`config/config.php`_

#### 2. Also change some database configurations in that file.

#### 3. Enjoy :)

## ==== **Install** ====

### Create db and tables by go to browser type this url

```bash
1. create executable for db_create.sh 
  sudo chmod +x db_create.sh
2. run db_create.sh file
  ./db_create.sh
```

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
class AuthController{

  function __construct(){
    $this->repo = new Repo();
  }

  public function yourcontroller(){
    #- your logics here
  }

```

### **View**

```php
//== TEMPLATE VIEW ==//
class Template extends Plug{

  function __construct(){
    parent::__construct();
    $this->main = strtolower(get_class($this));
  }
  #- render page you want
  public function index(){
    $this->view->render($this->main,"index");
  }
  #- target your controller
    public function logic(){
    $this
    ->controller
    ->logic();
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
  //... <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
  //...
</form>
```

### **SQL Repo**

#### _Query by id from table_

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

#### _Query by custom query from SQL_

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

### === Libralies Include === ###
### 1. Send-Mail ###
```php
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

$transport = Transport::fromDsn('smtp://localhost');
$mailer = new Mailer($transport);

$email = (new Email())
    ->from('hello@example.com')
    ->to('you@example.com')
    //->cc('cc@example.com')
    //->bcc('bcc@example.com')
    //->replyTo('fabien@example.com')
    //->priority(Email::PRIORITY_HIGH)
    ->subject('Time for Symfony Mailer!')
    ->text('Sending emails is fun again!')
    ->html('<p>See Twig integration for better HTML integration!</p>');

$mailer->send($email);
```

### 2. PDF Handler ###
```php 
// reference the Dompdf namespace
use Dompdf\Dompdf;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream();
```
config options
```php
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);
```

### 3. CSV Handler ###
see docs at https://csv.thephpleague.com/9.0/