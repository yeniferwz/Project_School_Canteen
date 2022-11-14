<?php
class detallsController extends Controller
{
    protected $data = array();
    protected $model = null;

    public function loadDb()
    {
        $this->model = Model::getInstance("comanda");
    }
    public function doAction()
    {
        if(isset($this->action)){
            $this->data["id"]=$this->action;
            $this->data["lineas"]=$this->model->infoComanda($this->action);
            $this->data["prod"]=$this->model->infoProductes( $this->data["lineas"]);
        }
    }
    public function render()
    {
         View::render("detalls",$this->data);

    }
}