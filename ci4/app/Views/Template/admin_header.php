<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title><?= isset($title) ? $title : 'Admin'; ?></title> 
    <link rel="stylesheet" href="<?= base_url('/style.css');?>"> 
</head> 
<body> 
    <div id="container"> 
    <header> 
        <h1>Admin Panel - Portal Berita</h1> 
    </header> 
    <nav> 
        <a href="<?= base_url('/admin/home');?>" class="active">Home</a> 
        <a href="<?= base_url('/admin/artikel');?>">Manajemen Artikel</a> 
        <a href="<?= base_url('/admin/artikel/add');?>">Tambah Artikel</a> 
        <a href="<?= base_url('/user/logout');?>">Keluar</a> 
    </nav> 
    <section id="wrapper"> 
        <section id="main">
