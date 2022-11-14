<?php
class finishController extends Controller
{
    protected $data = array();
    protected $model2 = "";

    public function loadDb()
    {
        $this->model = Model::getInstance("menu");
        $this->model2 = Model::getInstance("comanda");
    }
    public function doAction()
    {
        $nom = $_POST["nom"];
        $cognom = $_POST["cognom"];
        $correu = $_POST["correu"];
        $telefon = $_POST["telf"];
        $productes = json_decode($_POST["rebut"]);
        $existent = $this->model->comprovarUsuari($correu);
        if ($existent == false) {
            $this->model->insertUsuari($nom, $cognom, $correu, $telefon);
            $this->data["idComanda"] = $this->model->insertComanda($productes, $correu);
        } else {
            $this->data["idComanda"] = $this->model->insertComanda($productes, $correu);
        }
        $this->model->enviarCorreu($nom, $cognom, $correu, $this->data["idComanda"]);
    }
    public function render()
    {
        View::render("finish", $this->data);
    }
}
