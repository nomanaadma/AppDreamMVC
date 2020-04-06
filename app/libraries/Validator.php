<?php 

class Validator
{
    private $errors = [];

    public static function data(Array $data, Array $rules)
    {
        $validator = new self;
        $validator->validate($data, $rules);
        return $validator->getErrors();
    }

    public function validate(Array $data, Array $rules)
    {
        $valid = true;

        foreach ($rules as $item => $ruleset) {
            // required|email|min:8
            $ruleset = explode('|', $ruleset);
            foreach ($ruleset as $rule) {
                $pos = strpos($rule, ':');
                if ($pos !== false) {
                    $param = substr($rule, $pos+1);
                    $rule = substr($rule, 0, $pos);
                } else {
                    $param = '';
                }
                // validateEmail($item, $value, $param)
                $methodName = 'validate' . ucfirst($rule);
                if (method_exists($this, $methodName)) {
                    $this->$methodName($item, $data[$item], $param) OR $valid = false;
                }
            }

        }

        return $valid;
    }

    public function validateEmail($item, $value, $param)
    {
        if( !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$item][] = 'The ' . $item . ' field should be a valid email address';
            return false;
        }
        return true;
    }
    
    public function validateRequired($item, $value, $param)
    {
        if( $value === '' || $value === NULL) {
            $this->errors[$item][] = 'The ' . $item . ' field is required';
            return false;
        }
        return true;
    }

    public function validateMin($item, $value, $param)
    {
        if(strlen($value) >= $param == false ) {
            $this->errors[$item][] = 'The ' . $item . ' field should have a minimum length of ' .$param;
            return false;
        }
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
