<div class="articles form content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Añadir Artículo') ?></legend>
        <?php
            // El primer parámetro DEBE ser el nombre exacto de la columna en tu BD ('title')
            echo $this->Form->control('title', ['label' => 'Título del Artículo']);
            
            // El primer parámetro DEBE ser el nombre exacto de la columna en tu BD ('body')
            echo $this->Form->control('body', ['rows' => '5', 'label' => 'Contenido']);
            
            // El primer parámetro DEBE ser el nombre exacto de la columna en tu BD ('published')
            echo $this->Form->control('published', ['label' => '¿Publicar inmediatamente?']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar Artículo')) ?>
    <?= $this->Form->end() ?>
</div>