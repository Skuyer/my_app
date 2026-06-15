<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateArticlesTags extends BaseMigration
{
    public bool $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/guides/writing-migrations/migration-methods.html#the-change-method
     *
     * @return void
     */
    public function change(): void
{
    $table = $this->table('articles_tags', [
        'id' => false,
        'primary_key' => ['article_id', 'tag_id'],
    ]);

    $table
        ->addColumn('article_id', 'integer', [
            'null' => false,
        ])
        ->addColumn('tag_id', 'integer', [
            'null' => false,
        ])
        ->addColumn('created', 'datetime', [
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'null' => false,
        ])
        ->create();
}
}
