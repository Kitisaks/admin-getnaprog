# **School Dev**

### ==== **Structure** ====
```c
|= index.php  --> "1st plug to get _req from client browser"
|= data  --> "data for use in application"
|= controller --> "logicals of web application (e.g, query, filter, statistics)"
|= view  --> "views for all directories"
|= priv  --> "keep all privacy data"
|= config --> "e.g, router, config"
|= assets --> "keep all static items (e.g, js, css)" 
```

### ==== **Directories** ====
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

### ==== Documentories ====
- Docs for css. [tailwindCSS](https://tailwindcss.com/docs)
- Docs for js. [jQuery](https://api.jquery.com/)
- Docs for PHP. [PHP](https://www.php.net/docs.php)

### ==== Template ====
#### *Controller*
```php
//== TEMPLATE CONTROLLER ==//
class template{ 
 
  function __construct(){
    #- scope 'template/'
  }
  public function other(){
    #- scope 'template/other/'
  }
}
```
#### *Token check*
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
<input type="hidden" name="token" value="<?php echo $token; ?>" />
//...
</form>
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
