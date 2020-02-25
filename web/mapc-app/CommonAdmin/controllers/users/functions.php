<?php

function &getConnection(){
    $db = new PDO('sqlite:users.sqlite');
    return $db;
}

function closeConnection ($db){
    $db = NULL;
}

//create the database if does not exist
function createUsersTable($db){
    $db->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, category TEXT, name TEXT, regDate TEXT, uuid TEXT, etc TEXT)");
}

function resetUsersTable($db){
    dropUsersTable($db);
    createUsersTable($db);
    loadDefaultUsers($db);
}

function dropUsersTable($db){
    $db->exec("DROP TABLE IF EXISTS users");
}

function loadDefaultUsers($db){
    $query = $db->prepare('INSERT INTO users (id, category, name, regDate, uuid, etc) VALUES(:id, :category, :name, :regData, :uuid, :etc)');
    $data = array(
        array(
            'id' => 1,
            'category' => '서울',
            'name' => '홍길동',
            'regDate' => '2019-11-19',
            'uuid' => 'AAAAA',
            'etc' => ''
        ),
        array(
            'id' => 2,
            'category' => '서울',
            'name' => '김구',
            'regDate' => '2019-11-20',
            'uuid' => 'AAAAA',
            'etc' => ''
        ),
        array(
            'id' => 3,
            'category' => '서울',
            'name' => '윤봉길',
            'regDate' => '2019-11-20',
            'uuid' => 'AAAAA',
            'etc' => ''
        ),
        array(
            'id' => 4,
            'category' => '서울',
            'name' => '안중근',
            'regDate' => '2019-11-19',
            'uuid' => 'AAAAA',
            'etc' => ''
        ),
        array(
            'id' => 5,
            'category' => '서울',
            'name' => '유관순',
            'regDate' => '2019-11-22',
            'uuid' => 'AAAAA',
            'etc' => ''
        ),
    );

    foreach($data as $index => $value){
        $query->bindValue(':id', $value['id'], PDO::PARAM_INT);
        $query->bindValue(':category', $value['category'], PDO::PARAM_STR);
        $query->bindValue(':name', $value['name'], PDO::PARAM_STR);
        $query->bindValue(':regDate', $value['regDate'], PDO::PARAM_STR);
        $query->bindValue(':uuid', $value['uuid'], PDO::PARAM_STR);
        $query->bindValue(':etc', $value['etc'], PDO::PARAM_STR);
        $query->execute();
    }
}

function &loadUsers($db){
    $select = $db->prepare('SELECT * FROM users ORDER BY id ASC LIMIT 100');
    $select->execute();

    return $select;
}

function usersTableExists($db){
    $result = $db->query("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='users'");

    $row = $result->fetch(PDO::FETCH_NUM);

    return $row[0] > 0;
}
