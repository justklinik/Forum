<?php
/**
 * thread.php — Tek başlık (konu) detayı + yanıtlar
 *
 * NOT (Claude Code'a):
 *  - JavaScript YOK. Yanıt formu <form method="post"> ile gönderilir.
 *  - "Görüntülenme" sayısı ve "PGP ile imzala" seçeneği YOK; ekleme.
 *  - Başlık etiketleri (#pgp vb.) YOK.
 *  - $thread['id'] = (int)$_GET['id'] üzerinden DB'den çekilecek.
 *  - Yanıt gövdesini ekrana basarken htmlspecialchars() kullan.
 */

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// ---- ÖRNEK VERİ (DB ile değiştirilecek) -------------------------------
$thread = [
  'baslik' => 'PGP anahtarı doğrulama rehberi',
  'kategori_slug' => 'guvenlik',
  'kategori_ad' => 'güvenlik',
  'slug' => 'pgp-rehberi',
  'yanit' => 48,
  'son' => '2 saat önce',
];

$posts = [
  [
    'no'=>1,'yazar'=>'m4lr0v','avatar'=>'m4','rol'=>'pgp','rozet'=>'● PGP doğrulanmış',
    'zaman'=>'2 saat önce','op'=>true,
    'govde'=>"Bir satıcının anahtarını doğrulamadan asla mesaj şifrelemeyin. Parmak izini her zaman ikinci bir kanaldan teyit edin.",
    'kod'=>'gpg --fingerprint 0xA1B2…',
  ],
  [
    'no'=>2,'yazar'=>'satici_07','avatar'=>'07','rol'=>'vendor','rozet'=>'✦ Doğrulanmış Satıcı',
    'zaman'=>'1 saat önce','op'=>false,
    'govde'=>"Parmak izini profilimdeki sabitlenmiş anahtarla karşılaştırın; başka kaynaklara güvenmeyin.",
    'kod'=>null,
  ],
];
function postRozetCls($rol){ return $rol==='pgp'?'pill--pgp':($rol==='vendor'?'pill--vendor':''); }
// -----------------------------------------------------------------------

$pageTitle = $thread['baslik'];
$activeNav = 'forum';
include __DIR__ . '/partials/header.php';
?>

  <nav class="crumb">
    <span>forum / <?= htmlspecialchars($thread['kategori_ad']) ?> / <span class="here"><?= htmlspecialchars($thread['slug']) ?></span></span>
    <a href="forum.php">&larr; geri</a>
  </nav>

  <section class="thread-head">
    <h1><?= htmlspecialchars($thread['baslik']) ?></h1>
    <div class="info">
      <span><b><?= (int)$thread['yanit'] ?></b> yanıt</span>
      <span>son: <?= htmlspecialchars($thread['son']) ?></span>
    </div>
  </section>

  <?php foreach($posts as $p): ?>
    <article class="post<?= $p['op']?' post--op':'' ?>">
      <div class="post__head">
        <div class="avatar<?= $p['rol']==='pgp'?' avatar--admin':'' ?>"><?= htmlspecialchars($p['avatar']) ?></div>
        <div>
          <div style="display:flex;gap:8px;align-items:center;">
            <span class="post__name"><?= htmlspecialchars($p['yazar']) ?></span>
            <?php if($p['rozet']): ?><span class="pill <?= postRozetCls($p['rol']) ?>"><?= htmlspecialchars($p['rozet']) ?></span><?php endif; ?>
          </div>
          <div class="post__id">#<?= (int)$p['no'] ?> · <?= htmlspecialchars($p['zaman']) ?></div>
        </div>
      </div>
      <div class="post__body"><?= nl2br(htmlspecialchars($p['govde'])) ?></div>
      <?php if(!empty($p['kod'])): ?>
        <div class="code"><?= htmlspecialchars($p['kod']) ?></div>
      <?php endif; ?>
    </article>
  <?php endforeach; ?>

  <form class="reply" method="post" action="reply.php">
    <input type="hidden" name="thread_id" value="<?= (int)$id ?>">
    <textarea name="govde" placeholder="Yanıtını yaz…"></textarea>
    <div class="reply__bar">
      <span class="reply__hint">Markdown desteklenir</span>
      <button type="submit" class="btn btn--primary">Gönder</button>
    </div>
  </form>

<?php include __DIR__ . '/partials/footer.php'; ?>
