<?php
/*
 * Copyright 2014 Yukino Hayakawa<tennencoll@gmail.com>
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
?>

<?php

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    exit();
}

if(!isset($_POST['role']) || !isset($_POST['match']))
{
    exit();
}

if($_POST['match'] != 'male' && $_POST['match'] != 'female')
{
    exit('Unknown seek target.');
}

require_once("common.php");

$role = new Role($_POST['role']);

if(!$role->isValid())
{
    exit('Invalid role.');
}

$seek = $_POST['match'];

$sid = moe_createSession($role->role, $role->sex, $seek);

header('Location: waitingRoom.php?sid=' . $sid);