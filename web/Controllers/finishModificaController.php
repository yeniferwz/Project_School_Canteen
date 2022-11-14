<?php
class finishModificaController extends Controller
{
    protected $data = array();
    

    public function loadDb()
    {
        $this->model = Model::getInstance("comanda");  
    }
    public function doAction()
    {
        $id_comanda=$_POST['id_Comanda'];
        $rebut=json_decode($_POST['rebut']);
        $this->data['id']=$this->model->updateComanda($id_comanda,$rebut);
    }
    public function render()
    {
           
        View::render("finishModifica", $this->data);
            
    }
}
