<table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data de Lançamento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($films as $film) : ?>
                <tr>
                    <td><a href="<?php echo BASE_URL . 'films/details?search=' . $film->pos; ?>"><?php echo htmlspecialchars($film->title); ?></a></td>
                    <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($film->release_date))); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>