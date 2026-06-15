<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Iniciar Sesión</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Por favor, introduce tu email y contraseña') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Ingresar')); ?>
    <?= $this->Form->end() ?>

    <?= $this->Html->link("¿No tienes cuenta? Regístrate aquí", ['action' => 'add']) ?>
</div>