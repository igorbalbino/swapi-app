<?php include __DIR__ . '/../layouts/default.php'; ?>

<div class="container mt-5">
    <h1>Logs de Requisições</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Data/Hora</th>
                <th>Requisição</th>
                <th>Mensagem</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($logs)): ?>
              <tr>
                <td colspan="3">Nenhum log encontrado</td>
              </tr>
            <?php else: ?>
                <?php foreach ($logs as $log) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($log['date_time']))); ?></td>
                        <td><?php echo htmlspecialchars($log['request']); ?></td>
                        <td><?php echo htmlspecialchars($log['message']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>