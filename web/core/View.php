<?php
//alternativa => https://github.com/Xeoncross/1kb-PHP-MVC-Framework/blob/master/classes/view.php
class View
{

    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        //Crea les diferents variables a partir de un array asociatiu(Hash map).
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/Views/" . $view . "View.php";  // relative to Core directory

        if (is_readable($file)) {
            require dirname(__DIR__) . "/includesGeneral.php";
            if($view=='index'){
                require dirname(__DIR__). "/includeIndex.php";
                require $file;
                require dirname(__DIR__) . "/Views/footerView.php";
            }
            else if($view=='menu' || $view=='menuModifica'){
                require dirname(__DIR__). "/includeMenu.php";
                require dirname(__DIR__) . "/Views/headerView.php";
                require $file;
                require dirname(__DIR__) . "/Views/footerView.php";
            }
            else if($view=='ticket' || $view=='ticketModifica'){
                require dirname(__DIR__). "/includeTicket.php";
                require dirname(__DIR__) . "/Views/headerView.php";
                require $file;
                require dirname(__DIR__) . "/Views/footerView.php";
            }else if($view=='finish' || $view=='finishModifica' || $view=='comandaFeta'){
                require dirname(__DIR__). "/includeFinish.php";
                require dirname(__DIR__) . "/Views/headerView.php";
                require $file;
                require dirname(__DIR__) . "/Views/footerView.php";
            }else if($view=='admin' || $view=='detalls'){
                require dirname(__DIR__). "/includeAdmin.php";
                require dirname(__DIR__) . "/Views/headerView.php";
                require $file;
                require dirname(__DIR__) . "/Views/footerView.php";
            }else{
                require dirname(__DIR__) . "/Views/headerView.php";
                require $file;
                require dirname(__DIR__) . "/Views/footerView.php";
            }
            
        } else {
            throw new \Exception("$file not found");
        }
    }

    public static function fetch($view, $args = []){
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/fetch/" . $view . "Fetch.php";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
}
