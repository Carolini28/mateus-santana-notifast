<?php
App::uses('AppController', 'Controller');

class ApiController extends AppController {
	public $uses = array();

	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();

		$this->loadModel('Usuario');
		$user = '';
		if (isset($this->request->query['user']) && !empty($this->request->query['user'])) {
			$user = $this->request->query['user'];
		}
		$key = '';
		if (isset($this->request->query['key']) && !empty($this->request->query['key'])) {
			$key = $this->request->query['key'];
		}

		if (empty($user) || empty($key)) {
			$this->_error(array(
				'code'    => 1,
				'message' => 'Erro na autenticação do usuário.'
			));
		}
	}
	
	public function _content() {
		return json_decode(file_get_contents('php://input'), true);
	}

	public function _send($response) {
		$this->layout = false;
		$this->autoRender = false;
		$json = json_encode($response);
		header('Content-Type: application/json; charset=UTF-8');
		echo $json;
		die();
	}

	public function _success($response) {
		$this->_send($response);
	}

	public function _error($response) {
		header('HTTP 404 Not Found', true, 404);
		$this->_send(array(
			'error' => $response
		));
	}

	public function _buscarCliente($cpf, $numero_ligacao) {
		$this->loadModel('Cliente');
		return $this->Cliente->find('first', array(
			'Cliente.cpf' => $cpf,
			'Cliente.numero_ligacao' => $numero_ligacao
		));
	}

	public function save_cliente() {
		$this->loadModel('Cliente');

		$content = $this->_content();
		$cliente = $this->_buscarCliente($content['cpf'], $content['numero_ligacao']);
		if (!empty($cliente)) {
			$content['id'] = $cliente['Cliente']['id'];
		} else {
			$this->Cliente->create();
		}

		if ($this->Cliente->save($content)) {
			$this->_success(array(
				'message' => 'Cliente salvo com sucesso.'
			));
		} else {
			$this->_error(array(
				'code'    => 2,
				'message' => 'Erro ao salvar cliente.'
			));
		}
	}

	public function save_chamado() {
		$this->loadModel('Chamado');

		$content = $this->_content();
		$cliente = $this->_buscarCliente($content['cpf'], $content['numero_ligacao']);

		if (empty($cliente)) {
			return $this->_error(array(
				'code'    => 3,
				'message' => 'Cliente inexistente.'
			));
		}
		unset($content['cpf'], $content['numero_ligacao']);
		$content['clientes_id'] = $cliente['Cliente']['id'];
		if (!isset($content['id'])) {
			$this->Chamado->create();
		}
		if ($this->Chamado->save($content)) {
			$this->_success(array(
				'message' => 'Chamado salvo com sucesso.'
			));
		} else {
			$this->_error(array(
				'code'    => 4,
				'message' => 'Erro ao salvar chamado.'
			));
		}
	}

	public function save_evento() {
		$this->loadModel('EventoChamados');

		$content = $this->_content();

		if (!isset($content['id'])) {
			$this->EventoChamados->create();
		}
		if ($this->EventoChamados->save($content)) {
			$this->_success(array(
				'message' => 'Evento salvo com sucesso.'
			));
		} else {
			$this->_error(array(
				'code'    => 5,
				'message' => 'Erro ao salvar evento.'
			));
		}
	}

	public function save_servico() {
		$this->loadModel('Servico');

		$content = $this->_content();

		if (!isset($content['id'])) {
			$this->Servico->create();
		}
		if ($this->Servico->save($content)) {
			$this->_success(array(
				'message' => 'Serviço salvo com sucesso.'
			));
		} else {
			$this->_error(array(
				'code'    => 6,
				'message' => 'Erro ao salvar serviço.'
			));
		}
	}

}