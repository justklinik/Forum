<?php
/**
 * admin/partials/admin-header.php — Admin üst menüsü + sayfa başlangıcı
 *
 * NOT (Claude Code'a):
 *  - Bu dosya admin/ klasöründen çağrılır; CSS yolu ../assets/... olur.
 *  - Sayfaya GİRMEDEN ÖNCE oturum/yetki kontrolü yap:
 *        if (!is_admin()) { header('Location: /auth/login.php'); exit; }
 *  - HTML burada açılır, admin/partials/admin-footer.php ile kapanır.
 */
if (!isset($pageTitle)) { $pageTitle = 'Yönetim'; }
if (!isset($activeAdmin)) { $activeAdmin = 'forum'; }
$base = '../'; // admin/ -> kök
?><!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?> — Saykonot Yönetim</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $base ?>assets/forum.css">
</head>
<body>
  <header class="topbar">
    <div class="topbar__inner">
      <a class="brand" href="<?= $base ?>admin/index.php">
        <span class="brand__mark"></span>
        <span class="brand__name">saykonot</span>
        <span class="badge-admin">YÖNETİCİ</span>
      </a>
      <nav class="nav">
        <a href="<?= $base ?>admin/index.php"<?= $activeAdmin==='panel'?' class="is-active"':'' ?>>Panel</a>
        <a href="<?= $base ?>admin/uyeler.php"<?= $activeAdmin==='uyeler'?' class="is-active"':'' ?>>Üyeler</a>
        <a href="<?= $base ?>admin/forum.php"<?= $activeAdmin==='forum'?' class="is-active"':'' ?>>Forum</a>
        <a href="<?= $base ?>admin/urunler.php"<?= $activeAdmin==='urunler'?' class="is-active"':'' ?>>Ürünler</a>
        <a href="<?= $base ?>admin/raporlar.php"<?= $activeAdmin==='raporlar'?' class="is-active"':'' ?>>Raporlar</a>
      </nav>
    </div>
  </header>
  <main class="wrap wrap--wide">
