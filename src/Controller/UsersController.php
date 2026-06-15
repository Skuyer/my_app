<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Configuración de acciones públicas que no requieren inicio de sesión.
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Permitir que el login y el registro (add) sean públicos
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    /**
     * Iniciar Sesión (Login)
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        
        // 1. Si el usuario envía datos a través del formulario (POST)
        if ($this->request->is('post')) {
            // Obtenemos el resultado después de que el Middleware procesó el intento de login
            $result = $this->Authentication->getResult();
            
            if ($result && $result->isValid()) {
                $redirect = $this->request->getQuery('redirect', '/');
                return $this->redirect($redirect);
            }
            
            // Si el resultado no fue válido, mostramos el error
            $this->Flash->error(__('Usuario o contraseña inválidos.'));
        }
        
        // 2. Si entra por GET pero ya tiene una sesión activa en el navegador, lo mandamos al inicio
        $result = $this->Authentication->getResult();
        if ($this->request->is('get') && $result && $result->isValid()) {
            return $this->redirect('/');
        }
    }

    /**
     * Cerrar Sesión (Logout)
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        
        // Si hay una sesión activa, destruye la sesión y redirige
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
        }
        
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Index method - Lista de usuarios (Requiere estar logueado)
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method - Ver detalle de usuario (Requiere estar logueado)
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);

        $this->set(compact('user'));
    }

    /**
     * Registrar Usuario (Add) - Público
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido registrado con éxito.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('El usuario no pudo ser registrado. Por favor, intenta de nuevo.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method - Editar un usuario (Requiere estar logueado)
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido actualizado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no pudo ser actualizado. Por favor, intenta de nuevo.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method - Eliminar un usuario (Requiere estar logueado)
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El usuario no pudo ser eliminado. Por favor, intenta de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}