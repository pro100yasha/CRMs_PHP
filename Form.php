<?php
class Form{
    public static $name;
    public static $phone;
    public static $comment;

    function __construct($name, $phone, $comment){
        Form::$name = $name;
        Form::$phone = $phone;
        Form::$comment = $comment;
    }
}
?>