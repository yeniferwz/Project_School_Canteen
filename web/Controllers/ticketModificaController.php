<?php
class ticketModificaController extends Controller
{
    protected $data = array();

    public function loadDb()
    {
        //echo "DB loaded [from index]!!<br>";
    }
    public function doAction()
    {
        //echo "<hr>do action  [from index]!!!<br>";
    }
    public function render()
    {
        View::render("ticketModifica", $this->data);
    }
}