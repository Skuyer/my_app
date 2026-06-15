<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    /**
     * Index method
     */
    public function index()
    {
        $query = $this->Articles->find();
        $articles = $this->paginate($query);

        $this->set(compact('articles'));
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        // Si usas IDs numéricos, se queda con get()
        $article = $this->Articles->get($id, contain: ['Tags']);
        $this->set(compact('article'));
    }

    /**
     * Add method
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Tu artículo ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo añadir tu artículo.'));
        }
        
        // Carga la lista de tags para el formulario multi-select
        $tags = $this->Articles->Tags->find('list', limit: 200)->all();
        $this->set(compact('article', 'tags'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        // Si usas IDs numéricos, se queda con get()
        $article = $this->Articles->get($id, contain: ['Tags']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        
        $tags = $this->Articles->Tags->find('list', limit: 200)->all();
        $this->set(compact('article', 'tags'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Tags method
     */
    public function tags(...$tags)
    {
        $articles = $this->Articles->find('tagged', tags: $tags)->all();
        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);
    }
}