<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Ano de Nascimento</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $item) : ?>
            <tr>
                <td><a href="<?php echo BASE_URL .'people/details?search=' . $item->pos; ?>"><?php echo htmlspecialchars($item->name); ?></a></td>
                <td><?php echo htmlspecialchars($item->birth_year); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>