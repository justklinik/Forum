<?php
/**
 * partials/header.php — site üst menüsü + sayfa başlangıcı (public)
 * Kullanım: include __DIR__ . '/partials/header.php';
 * Beklenen değişken (opsiyonel): $pageTitle, $activeNav ('forum' vb.)
 *
 * NOT (Claude Code'a): Bu dosya HTML'i AÇAR. Her sayfanın sonunda
 * mutlaka partials/footer.php ile kapatılmalıdır. Etiketleri eksik
 * bırakma; <html>, <head>, <body> yalnızca burada açılır.
 */
if (!isset($pageTitle)) { $pageTitle = 'Forum'; }
if (!isset($activeNav)) { $activeNav = 'forum'; }
// CSS'in kök yolu — alt klasörlerden (admin/) çağrılırsa $assetBase ayarlayın.
if (!isset($assetBase)) { $assetBase = ''; }
?><!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?> — Saykonot</title>
  <meta name="description" content="Saykonot — gizlilik odaklı, güvenli e-ticaret platformu. Kripto ödeme, PGP, JS yok.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $assetBase ?>assets/forum.css">
</head>
<body>
  <header class="topbar">
    <div class="topbar__inner">
      <a class="brand" href="<?= $assetBase ?>index.php">
        <span class="brand__mark"></span>
        <span class="brand__name">saykonot</span>
      </a>
      <nav class="nav">
        <a href="<?= $assetBase ?>index.php"<?= $activeNav==='home'?' class="is-active"':'' ?>>Ana Sayfa</a>
        <a href="<?= $assetBase ?>urunler.php"<?= $activeNav==='urunler'?' class="is-active"':'' ?>>Ürünler</a>
        <a href="<?= $assetBase ?>forum.php"<?= $activeNav==='forum'?' class="is-active"':'' ?>>Forum</a>
        <a href="<?= $assetBase ?>auth/login.php"<?= $activeNav==='giris'?' class="is-active"':'' ?>>Giriş</a>
        <a href="<?= $assetBase ?>auth/register.php"<?= $activeNav==='kayit'?' class="is-active"':'' ?>>Kayıt</a>
      </nav>
    </div>
  </header>
  <main class="wrap">
