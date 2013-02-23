<?php
highlight_file(__file__);
exit;

class Aggregate implements ArrayAccess, Countable, Iterator
{
    private $data = array();

    public function __construct($array=null)
    {
        if (!is_null($array)) {
            $this->data = $array;
        }
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function count()
    {
        return count($this->data);
    }

    public function current()
    {
        return current($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function next()
    {
        return next($this->data);
    }

    public function rewind()
    {
        return reset($this->data);
    }

    public function valid()
    {
        return current($this->data);
    }
}

$a = array('mama', 'tata', 'siostra', 'brat', 'kuzynka', 's±siadka');
$agg = new Aggregate($a);
echo $agg[2] . '<br />';
echo $agg[3] . '<br />';

foreach ($agg as $id=>$p) {
  printf('%d: %s<br >', $id, $p);
}

printf('<br /><br />Ilosæ elementów: %d<br /><br />', count($agg));

echo '<pre>';
print_r($agg);
unset($agg[3]);
print_r($agg);
$agg[3] = 'ciocia';
print_r($agg);
echo '</pre>';

?>
