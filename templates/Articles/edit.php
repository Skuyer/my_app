<h1>Editar Artículo</h1>
<?php
    echo $this->Form->create($article);
    echo $this->Form->control('title', ['label' => 'Título']);
    echo $this->Form->control('body', ['rows' => '3', 'label' => 'Contenido']);
    
    // MOVIDO: Ahora está dentro del formulario y formateado como una lista de selección múltiple
    echo $this->Form->control('tags._ids', [
        'options' => $tags, 
        'label' => 'Tags',
        'style' => 'height: 100px;' // Le da una altura cómoda para ver los elementos
    ]);

    echo $this->Form->button(__('Guardar artículo'));
    echo $this->Form->end();
?>