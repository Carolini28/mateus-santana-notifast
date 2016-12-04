<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

	public $components = array('Paginator', 'Session');

/**
 * Displays a view
 *
 * @return void
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	public function home()
	{
		$this->layout = 'login';

		$this->loadModel('Cliente');
		if ($this->request->is('post')) {
			if ($this->request->data('Cliente.cpf') == '' || $this->request->data('Cliente.numero_ligacao') == '')
				$this->Session->setFlash('Por favor, preencha o cpf e o número da ligação', 'msg', array('class' => 'danger', 'hide' => false));
			else {
				$cliente = $this->Cliente->find('first', array(
					'conditions' => array(
						'cpf'            => $this->request->data('Cliente.cpf'),
						'numero_ligacao' => $this->request->data('Cliente.numero_ligacao')
					)
				));
				if (!empty($cliente)) {
					if ($cliente['Cliente']['cadastrado']) {
						$this->Session->setFlash('Login realizado com sucesso', 'msg', array('class' => 'success', 'hide' => false));
						$this->Session->write('Cliente', $cliente['Cliente']);
						return $this->redirect(array('controller' => 'chamados', 'action' => 'index'));
					} else {
						$this->Session->write('ClienteCAD', $cliente['Cliente']);
						return $this->redirect(array('action' => 'cadastre_se'));
					}
				}
				$this->Session->setFlash('CPF e Número da Ligação não conferem', 'msg', array('class' => 'danger', 'hide' => false));
			}
		}

		$this->fb_setLoginUrl();
	}

	public function fb_setLoginUrl()
	{
		$helper = $this->Facebook->getRedirectLoginHelper();
		$fb_loginUrl = $helper->getLoginUrl(Router::url(array('action' => 'fb_login'), true), array());
		$this->set(compact('fb_loginUrl'));
	}

	public function send_notification() {
		$this->autoRender = false;

		$helper = $this->Facebook->getCanvasHelper();

		try {
			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			return $this->fb_message();
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			return $this->fb_message();
		}

		if (!isset($accessToken))
			return $this->fb_message();

		$sendNotif = $fb->post('/' . '1189803094402807' . '/notifications', array('href' => '?true=43', 'template' => 'click here for more information!'), $accessToken);
		print_r($sendNotif);
		exit();
	}

	public function fb_login()
	{
		$this->loadModel('Cliente');

		$this->autoRender = false;

		$helper = $this->Facebook->getRedirectLoginHelper();

		try {
			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			return $this->fb_message();
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			return $this->fb_message();
		}

		if (!isset($accessToken))
			return $this->fb_message();

		try {
			$response = $this->Facebook->get('/me?fields=id,name', $accessToken);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			return $this->fb_message();
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			return $this->fb_message();
		}

		$user = $response->getGraphUser();
		if (!isset($user['id']) || empty($user['id']))
			return $this->fb_message();

		$cliente = $this->Cliente->find('first', array(
			'conditions' => array('fb_id' => $user['id'], 'fb' => true)
		));
		if (empty($cliente)) {
			$this->Session->write('ClienteFB', array(
				'id'    => $user['id'],
				'nome'  => (isset($user['name']) ? $user['name'] : '')
			));
			return $this->fb_message(null, null, array('action' => 'cadastre_se'));
		}
		
		$this->Session->write('Cliente', $cliente['Cliente']);
		$this->fb_message('Login realizado com sucesso', 'success', array('controller' => 'chamados', 'action' => 'index'));
	}

	public function fb_message($msg = 'Ocorreu um erro na conexão com Facebook', $class = 'danger', $url = array('action' => 'home'))
	{
		if ($msg !== null)
			$this->Session->setFlash($msg, 'msg', array('class' => $class, 'hide' => false));
		return $this->redirect($url);
	}

	public function cadastre_se()
	{
		$this->loadModel('Cliente');

		$this->layout = 'login';

		if ($this->request->is('post')) {
			$facebook = $this->Session->check('ClienteFB');
			if ($facebook)
				$clienteFB = $this->Session->read('ClienteFB');
			$cliente = $this->Cliente->find('first', array(
				'conditions' => array(
					'Cliente.cpf' => $this->request->data('Cliente.cpf'),
					'Cliente.numero_ligacao' => $this->request->data('Cliente.numero_ligacao')
				)
			));
			if (empty($cliente))				
				$this->Session->setFlash('CPF e Número da Ligação não conferem', 'msg', array('class' => 'danger', 'hide' => false));
			elseif ($cliente['Cliente']['cadastrado'])
				$this->Session->setFlash('Cliente já cadastrado anteriormente', 'msg', array('class' => 'danger', 'hide' => false));
			else {
				$this->request->data['Cliente']['id'] = $cliente['Cliente']['id'];
				if ($facebook) {
					$this->request->data['Cliente']['fb']    = true;
					$this->request->data['Cliente']['fb_id'] = $clienteFB['id'];
				}
				$this->request->data['Cliente']['cadastrado'] = true;

				if ($this->Cliente->save($this->request->data)) {
					$this->Session->setFlash('Cadastro realizado com sucesso', 'msg', array('class' => 'success', 'hide' => false));
					if ($facebook)
						$this->Session->delete('ClienteFB');
					return $this->redirect(array('controller' => 'chamados', 'action' => 'index'));
				}
				$this->Session->setFlash('Falha ao realizar cadastro', 'msg', array('class' => 'danger', 'hide' => false));
			}
		}

		if ($this->Session->check('ClienteCAD')) {
			$this->request->data['Cliente'] = $this->Session->read('ClienteCAD');
			$this->Session->delete('ClienteCAD');
		}
	}

	public function logout() {
		$this->autoRender = false;
		$this->Session->delete('Cliente');
		return $this->redirect(array('action' => 'home'));
	}
}
