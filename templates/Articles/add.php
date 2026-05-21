<h1>Añadir Artículo</h1>
<?php
    echo $this->Form->create($articles);
    // Cambia 'title' y 'body' por los nombres reales de tus columnas en la base de datos
    echo $this->Form->control('Articles');
    echo $this->Form->control('creación', ['rows' => '3']);
    echo $this->Form->button(__('Guardar Artículo'));
    echo $this->Form->end();
?>