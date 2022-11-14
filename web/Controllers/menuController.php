<?php
class menuController extends Controller
{
    protected $data = array();
    protected $model = null;

    public function loadDb()
    {
        $this->model = Model::getInstance("menu");
    }
    public function doAction()
    {
        if ($this->action == "fetchMenu") {
            $this->data["menus"] = $this->model->getMenu();
        }
    }
    public function render()
    {
        if ($this->action == "fetchMenu") {
            View::fetch("menu", $this->data);
        } else {
            View::render("menu");
        }
    }
}
