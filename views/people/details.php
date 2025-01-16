<?php include __DIR__ . '/../layouts/default.php'; ?>

<div class="container mt-5">
    <h1>Detalhes da Pessoa</h1>
    <h2><?php echo htmlspecialchars($people->title ?? 'N/A'); ?></h2>
    <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($people->birth_year ?? 'N/A'); ?></p>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>