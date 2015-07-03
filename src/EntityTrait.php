<?php
/**
 * Created by PhpStorm.
 * User: houghtelin
 * Date: 7/3/15
 * Time: 5:25 PM
 */

namespace CodeJet;

trait EntityTrait {

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function getJsonArray()
    {
        return get_object_vars($this);
    }

    public function exchangeArray(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = $this->getSetterMethod($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    private function getSetterMethod($propertyName)
    {
        return "set" . str_replace(' ', '', ucwords(str_replace('_', ' ', $propertyName)));
    }
}
