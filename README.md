# Coil

---

Coil is an abstraction layer for PHP's cURL functions.

## Usage

For a basic use we provide a series of static methods to quickly get things done:

### Posting

To post (ie: a form) you can use the Post method as follow:

```php
<?php
Coil::post('http://example.com/post.php', array(
        'Hello' => 'World'
    ));
````

Posting files is currently not supported.

### Getting

You can easily retrieve the contents on any page as follow:

```php
<?php
$html = Coil::get('http://example.com/');
echo $html;
````

Passing parameters to the URL is also easily achieved with an extra parameter:

```php
<?php
$html = Coil::get('http://example.com/', array('page' => 2));
echo $html;
````

Above code will request the page ```http://example.com/?page=2```.

### HEAD

To retrieve info about a host or page there is the Head method:

```php
<?php
$res = Coil::head('http://example.com/');
var_dump($res);
````

### Fetch

Downloading files is achieved with the Fetch method, as follow:

```php
<?php
Coil::fetch('http://example.com/favicon.ico', '/tmp/example.ico');
````

## Contact and Feedback

If you'd like to contribute to the project or file a bug or feature request, please visit [its page on GitHub][1].

## License

Coil is licensed under the [GNU GPL v3][2]([tldr][3]); that means you're allowed to copy, edit, change, hack, use all or any part of this project as you please *as long* as all parts of the project remains in the *public domain*.

  [1]: https://github.com/asphxia/coil
  [2]: http://www.gnu.org/licenses/gpl.html
  [3]: http://www.tldrlegal.com/license/gnu-general-public-license-v3-(gpl-3)
