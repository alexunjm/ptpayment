<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 16:56
 */

namespace Pckg\Payment\Handler;


use Pckg\Payment\Adapter\pseAdapter;
use Pckg\Payment\Services\PSE;

class Dispatcher
{

    /*private StudentView studentView;
    private HomeView homeView;

    public Dispatcher(){
    studentView = new StudentView();
    homeView = new HomeView();
    }

    public void dispatch(String request){
        if(request.equalsIgnoreCase("STUDENT")){
            studentView.show();
        }
        else{
            homeView.show();
        }
    }*/

    private $pseAdapter;

    /**
     * Dispatcher constructor.
     */
    public function __construct($handler)
    {
        if (strcasecmp($handler, "pse") == 0)
        {
            $this->pseAdapter = new pseAdapter(new PSE());
        }
    }

    public function dispatch($request)
    {
        if (strcasecmp($request, "getbanklist") == 0)
        {
            $this->pseAdapter->getBankList();
        }
    }
}