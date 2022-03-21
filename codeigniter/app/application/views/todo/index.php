<?php if (!empty($todos)): ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Label</th>
            <th scope="col" class="text-end">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($todos as $todo_item): ?>
            <tr>
                <th <?php if ($todo_item['completed']): ?>class="text-decoration-line-through"<?php endif ?>
                    scope="row"><?php echo $todo_item['id'] ?></th>
                <td <?php if ($todo_item['completed']): ?>class="text-decoration-line-through"<?php endif ?> ><?= $todo_item['label'] ?></td>
                <td class="text-end">
                    <a href="/edit/<?= $todo_item['id'] ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-pen"></i> Modifier
                    </a>
                    <a href="/toggle_completed/<?= $todo_item['id'] ?>" class="btn btn-sm btn-outline-success">
                        <?= $todo_item['completed'] ? '<i class="far fa-check-square"></i> Complétée' : '<i class="far fa-square"></i> Compléter' ?>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="alert alert-secondary">Aucune tâche à faire.</p>
<?php endif ?>

<p class="text-end">
    <a href="/create" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-plus"></i> Ajouter une tâche
    </a>
    <a href="/delete_all_completed" class="btn btn-sm btn-outline-danger">
        <i class="far fa-trash-alt"></i> Supprimer toutes les tâches faites
    </a>
</p>