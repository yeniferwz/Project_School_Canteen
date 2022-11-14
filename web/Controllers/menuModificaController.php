<?php
class menuModificaController extends Controller
{
    protected $data = array();
    protected $feta=false;
    

    public function loadDb()
    {
        $this->model = Model::getInstance("menu");  
    }
    public function doAction()
    {
        if(isset($this->action)){
            $this->data["id"]=$this->action;
            $this->feta=$this->model->estatComandaId($this->action);
        }
    }
    public function render()
    {
        if($this->feta==false){
                View::render("menuModifica");
        }else{
                View::render("comandaFeta",$this->data);
        }
            
    }
}
