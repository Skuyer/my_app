<div class="users form content">
    <?= $this->Flash->render() ?>
    <h3>Iniciar Sesión</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Por favor, introduce tu usuario y contraseña') ?></legend>
        <?= $this->Form->control('username', ['required' => true, 'label' => 'Usuario']) ?>
        <?= $this->Form->control('password', ['required' => true, 'label' => 'Contraseña']) ?>
    </fieldset>
    <?= $this->Form->button(__('Ingresar')); ?>
    <?= $this->Form->end() ?>

    <?= $this->Html->link("¿No tienes cuenta? Regístrate aquí", ['action' => 'add']) ?>
</div>