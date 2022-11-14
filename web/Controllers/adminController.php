<?php
class adminController extends Controller
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
         $options=explode(",",$this->action);
            if($options[0]=="fet"){
                error_log("doAction=> fet");
                $this->model->marcarComanda($options[1]);
            }
        }
        $this->data["comandes"]=$this->model->getComandas();
    }
    public function render()
    {
         View::render("admin",$this->data);
    }
}