<?php
    const
        host = 'db',
        users = 'users',
        name = 'name',
        dbUser = 'user',
        password = 'password',
        db = 'appDB',
        id = 'ID',
        description = 'description';

    function openMysqli(): mysqli { return new mysqli(
        host, dbUser, password, db
    ); }
?>
