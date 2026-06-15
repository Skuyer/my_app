<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class TagsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tags'); // Tu tabla en MySQL
        $this->setDisplayField('title'); // O el nombre de la columna que quieras mostrar (ej. 'name')
        $this->setPrimaryKey('id');

        // Si tienes la relación muchos a muchos de vuelta hacia artículos:
        $this->belongsToMany('Articles', [
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'article_id',
            'joinTable' => 'articles_tags',
        ]);
    }
}