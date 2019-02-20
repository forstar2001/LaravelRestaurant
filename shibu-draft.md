# how to change language using ip address 

~~~js

function changeLanguage (lang) {
    if (lang == 'en') {
        $("[data-langen]").each(function (index , val) {
            $(this).html($(this).attr('data-langen'));
        });
    } else {
        $("[data-langhe]").each(function (index , val) {
            $(this).html($(this).attr('data-langhe'));
        });
    }
}
if (localStorage.getItem('user_lang')) {
  let lang = localStorage.getItem('user_lang');
  changeLanguage(lang);
} else {
  $.get('http://ip-api.com/json', (response) => {
  	if (response.countryCode == "IL") {
      localStorage.setItem("user_lang", 'il')
      changeLanguage('he');
  	}
  })
}
~~~

# flatten array in php 

~~~php
public function flattenUnique(array $array) {
  $return = array();
  array_walk_recursive($array, function($a) use (&$return) { $return[] = intval($a); });
  return array_unique( $return );
}
~~~

# functions in php 

~~~php
array_values()  // it will removed key of associated array
json_decode() // decode json to php  // database array to php array
array_intersect() // common element between 2 array
~~~