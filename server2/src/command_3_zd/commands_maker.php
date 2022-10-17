<?php
function get_command($command){
    $result = match ($command) {
        'ls', 'ps', 'whoami', 'id', 'pwd' => exec($command)
    };
    return $result;
}