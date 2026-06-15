<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Listar Usuarios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column text-content">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Registrar Usuario') ?></legend>
                <?php
                    echo $this->Form->control('username', ['label' => 'Nombre de Usuario']);
                    echo $this->Form->control('password', ['label' => 'Contraseña', 'type' => 'password']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Registrar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>