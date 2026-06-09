<h1>Editar Artículo</h1>
<?php
    echo $this->Form->create($article);
    echo $this->Form->control('title', ['label' => 'Título']);
    echo $this->Form->control('body', ['rows' => '3', 'label' => 'Contenido']);
    echo $this->Form->button(__('Guardar artículo'));
    echo $this->Form->end();
?>