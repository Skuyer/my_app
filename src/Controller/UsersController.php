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
        $result = $this->Authentication->getResult();
        
        // Si el usuario ya está logueado o se acaba de loguear con éxito
        if ($result && $result->isValid()) {
            // Redirige a la URL que intentaba entrar, o por defecto al inicio de la app ('/')
            $redirect = $this->request->getQuery('redirect', '/');

            return $this->redirect($redirect);
        }
        
        // Si el usuario envió los datos (POST) pero falló la autenticación
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Usuario o contraseña inválidos.'));
        }
    }

    /**
     * Cerrar Sesión (Logout)
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        
        // Si hay una sesión activa, la destruye y redirige al login
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Index method - Listar usuarios (Requiere estar logueado)
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method - Ver detalle de un usuario (Requiere estar logueado)
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
     * Add method - Registro de nuevos usuarios (Es pública gracias al beforeFilter)
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido registrado exitosamente.'));

                // Redirige al login para que el usuario estrene su nueva cuenta
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('El usuario no pudo ser guardado. Por favor, intenta de nuevo.'));
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