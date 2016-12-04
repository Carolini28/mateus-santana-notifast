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

class ChamadosController extends AppController {



/**

 * This controller does not use a model

 *

 * @var array

 */

	public $uses = array();

	public function beforeFilter(){


		if(!$this->Session->check('Cliente')){
			return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
		}

	}



	public function index() {

        $chamados = $this->Chamado->find('all', array(
            'conditions' => array('Chamado.ativo' => true)
        ));
		
	    $this->set(compact('chamados'));

	}



	public function view($id = null) {

		$this->loadModel('Chamado');
		$chamado = $this->Chamado->find('all', array(
            'conditions' => array('Chamado.id' => $id)
        ));		

	    $this->loadModel('EventoChamado');
		$eventos = $this->EventoChamado->find('all', array(
            'conditions' => array('EventoChamado.chamados_id' => $id)
        ));

        $arr_meses = array(
	      '01' => 'Janeiro',
	      '02' => 'Fevereiro',
	      '03' => 'Março',
	      '04' => 'Abril',
	      '05' => 'Maio',
	      '06' => 'Junho',
	      '07' => 'Julho',
	      '08' => 'Agosto',
	      '09' => 'Setembro',
	      '10' => 'Outubro',
	      '11' => 'Novembro',
	      '12' => 'Dezembro'
	   );
        
	    $this->set(compact('eventos','hora','data', 'horario', 'mes', 'arr_meses','chamado'));		

	}

}

