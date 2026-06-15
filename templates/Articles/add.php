<div class="articles form content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Añadir Artículo') ?></legend>
        <?php
            echo $this->Form->control('title', ['label' => 'Título del Artículo']);
            echo $this->Form->control('body', ['rows' => '5', 'label' => 'Contenido']);
            echo $this->Form->control('published', ['label' => '¿Publicar inmediatamente?']);
            
            // CONFIGURADO: Forzado a renderizar una lista de selección múltiple con altura fija
            echo $this->Form->control('tags._ids', [
                'options' => $tags, 
                'label' => 'Tags',
                'style' => 'height: 100px;'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar Artículo')) ?>
    <?= $this->Form->end() ?>
</div>