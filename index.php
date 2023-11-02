<?php


class MetaCutOutIterator implements Iterator {
  private $items = [];
  private $pointer = 0;

  public function __construct($item) {
    $this->items=explode( '&gt;' , $item );
    $this->items = array_values($this->items );
  }

  public function current() {
   return ( !str_contains($this->items[$this->pointer],'&lt;meta ')  AND !!strlen($this->items[$this->pointer]))? $this->items[$this->pointer] . '&gt;' : '';
  }

  public function key() {
    return $this->pointer;
  }

  public function next() {
    $this->pointer++;
  }

  public function rewind() {
    $this->pointer = 0;
  }

  public function valid() {
    return $this->pointer < count($this->items);
  }
}

// Use it!
function printIterable(iterable $myIterable) {
 $ouputResult = '';
  foreach($myIterable as $item) {
    $ouputResult .= $item;
  }
return $ouputResult;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Itterables</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
                <style>textarea {margin-left: 4vw; width: 90vw;}</style>
	</head>
	<body>



 <?

$got_it= htmlspecialchars( file_get_contents(__DIR__ . DIRECTORY_SEPARATOR. 'html.htm') ) ;
  echo '<details><summary>In</summary><textarea>'.$got_it.'</textarea></details>';
$iterator = new MetaCutOutIterator ($got_it);
  echo '<details><summary>Out</summary><textarea>'.printIterable($iterator).'</textarea></details>';

?>

<script>
function textAreaAdjust(textareaobject) {
  textareaobject.style.height = "1px";
  textareaobject.style.height = (1+textareaobject.scrollHeight)+"px";
}
const textareasonpage=document.body.getElementsByTagName("textarea");
for (let i = 0; i < textareasonpage.length; i++) {
    textAreaAdjust(textareasonpage[i]);
    }
</script>
	</body>
</html>
