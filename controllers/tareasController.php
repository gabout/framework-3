<?php
/**
 * Clase tareasController
 * 
 * Clase para la gestión de tareas 
 * @author  Cristian Bernal <crisbera@gmail.com>
 */
class tareasController extends AppController{

	/**
	 * Método __construct
	 * 
	 * Método constructor de la clase 
	 * 
	 */
	public function __construct(){
		parent::__construct();

	}


    /**
	 * Método index
	 * 
	 * Método por default del controlador
	* @return  void no regresa ningún valor
	 */
	public function index(){
	
		$this->_view->titulo = "Listado de tareas";
        $options['field'] = "tareas.id AS id, tareas.nombre AS nombre, tareas.fecha AS fecha, tareas.prioridad AS prioridad, tareas.status, categorias.nombre AS categoria";
		$options['conditions'] ="tareas.categoria_id = categorias.id";
		$this->_view->tareas = $this->db->find('tareas,categorias','',$options);
		$this->_view->renderizar('index');
	}

    /**
	 * Método edit
	 * 
	 * Método que edita una tarea
	 * @param  $id la clave de la tarea
	 * @return  void no regresa ningún valor
	 */
	public function edit($id = NULL){
		if ($_POST){
				if($this->db->update('tareas', $_POST)){
				   $this->redirect(
						  array('controller'=>'tareas','action'=>'index'
							)
						);
			}else{
				$this->redirect(
						  array(
								'controller'=>'tareas',
								'action'=>'edit/'.$_POST['id']
							   )
						  );
					}

		}else{

				$conditions = array(
						  'conditions'=>'id='.$id);
				$this->_view->tarea=$this->db->find(
					'tareas',
					'first',
					$conditions
				);
                $this->_view->categorias = $this->db->find('categorias', 'all');
				$this->_view->titulo="Editar Tarea";
				$this->_view->renderizar('edit');

		}
	}

    /**
	 * Método add
	 * 
	 * Método que agrega una tarea
	 * @param  $data los datos de la tarea
	 * @return  void no regresa ningún valor
	 */
	public function add($data = array()){
        
	
		if ($_POST){

			if($this->db->save('tareas',$_POST)){

	           $this->redirect(array('controller'=>'tareas','action'=>'index'));

       		}else{

       			$this->redirect(array('controller'=>'tareas','action'=>'add'));

		    }

		}else{

			$this->_view->categorias = $this->db->find('categorias', 'all');
			$this->_view->titulo="Agregar tarea";
			$this->_view->renderizar=("add");

		}

		$this->_view->renderizar('add');

	}

    /**
	 * Método delete
	 * 
	 * Método que elimina una tarea
	 * @param  $id la clave de la tarea 
	 * @return  void no regresa ningún valor
	 */
	public function delete($id){
		$condition='id='.$id;
		if ($this->db->delete('tareas', $condition)){
			$this->redirect(array('controller'=>'tareas'));
		}
    }




}



?>