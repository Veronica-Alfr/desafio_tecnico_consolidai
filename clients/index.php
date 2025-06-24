<?php
$page = $_GET['page'] ?? 'list';

switch ($page) {
    case 'list':
        include 'views/list.php';
        break;
    case 'edit':
        include 'views/edit.php';
        break;
    default:
        include 'views/list.php';
        break;
}