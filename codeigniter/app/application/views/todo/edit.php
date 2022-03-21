<?php if (validation_errors()): ?>
    <p class="alert alert-danger">
        Le formulaire comporte des erreurs.
    </p>
<?php endif; ?>
<?php echo form_open($action) ?>
    <div class="mb-3">
        <label for="label" class="form-label">Label</label>
        <?= form_input(array(
            'name' => 'label',
            'id' => 'label',
            'class' => 'form-control',
            'value' => set_value('label', $todo['label']),
        ), $todo['label']) ?>
    </div>
    <div class="mb-3 form-check">
        <?= form_checkbox(array(
            'name' => 'completed',
            'id' => 'completed',
            'value' => 1,
            'class' => 'form-check-input',
            'checked' => (bool)$todo['completed']
        )) ?>
        <label class="form-check-label" for="completed">Complétée</label>
    </div>
    <button type="submit" name="submit" class="btn btn-sm btn-primary">Enregistrer</button>
<?php echo form_close() ?>
