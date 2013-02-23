<?php

highlight_file (__FILE__);
exit;

class Aggregate implements ArrayAccess, Countable, Iterator {
    private $_data = array();
    private $_pointer = 0;

    public function __construct($array=null) {
        if (!is_null($array)) {
            $this->_data = $array;
        }
    }

    public function offsetExists($offset) {
        return array_key_exists($offset, $this->_data);
    }

    public function offsetGet($offset) {
        return $this->_data[$offset];
    }

    public function offsetSet($offset, $value) {
        if (is_null ($offset)) {
            $this->_data[] = $value;
        }
        else {
            $this->_data[$offset] = $value;
        }
    }

    public function offsetUnset($offset) {
        unset($this->_data[$offset]);
    }

    public function count() {
        return count($this->_data);
    }

    public function current() {
        return $this->_data[$this->_pointer];
    }

    public function key() {
        return $this->_pointer;
    }

    public function next() {
        ++$this->_pointer;
        if (isset ($this->_data[$this->_pointer])) {
            return $this->_data[$this->_pointer];
        }
        else {
            return false;
        }
    }

    public function rewind() {
        return $this->_pointer = 0;
    }

    public function valid() {
        return isset ($this->_data[$this->_pointer]);
    }
}

$agg = new Aggregate ();
$agg[] = 'a';
$agg[] = 'b';
$agg[] = 'c';
$agg[] = 0;
$agg[] = false;
$agg[] = '';
$agg[] = 'e';

foreach ($agg as $k=>$v) {
    echo $k . ' => ' . $v . "<br />\n";
}

