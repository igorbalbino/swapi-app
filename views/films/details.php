<?php include __DIR__ . '/../layouts/default.php'; ?>

<div class="container mt-5">
    <h1>Detalhes do Filme</h1>
    <h2><?php echo htmlspecialchars($film->title); ?></h2>
    <p><strong>Episódio:</strong> <?php echo htmlspecialchars($film->episode_id); ?></p>
    <p><strong>Sinopse:</strong> <?php echo htmlspecialchars($film->opening_crawl); ?></p>
    <p><strong>Data de Lançamento:</strong> <?php echo htmlspecialchars(date('d/m/Y', strtotime($film->release_date))); ?></p>
    <p><strong>Diretor(a):</strong> <?php echo htmlspecialchars($film->director); ?></p>
    <p><strong>Produtor(es):</strong> <?php echo htmlspecialchars($film->producers); ?></p>
    <p><strong>Personagens:</strong> <?php echo htmlspecialchars(implode(', ', $film->characters)); ?></p>
    <p><strong>Idade do Filme:</strong> <?php echo $film->age['years']; ?> anos, <?php echo $film->age['months']; ?> meses e <?php echo $film->age['days']; ?> dias</p>
     <a href="<?php echo BASE_URL . 'films'; ?>" class="btn btn-primary">Voltar ao Catálogo</a>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>