<?php include __DIR__ . '/../layouts/default.php'; ?>
<div class="container mt-5">
    <h1>Catálogo de Filmes</h1>

    <form method="get" action="<?php echo BASE_URL . 'films/details'; ?>">
        <div class="form-group">
            <input type="text" class="form-control" name="search" placeholder="Pesquisar filmes..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary mt-2">Pesquisar</button>
        </div>
    </form>
    <?php include __DIR__ . '/list.php'; ?>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>