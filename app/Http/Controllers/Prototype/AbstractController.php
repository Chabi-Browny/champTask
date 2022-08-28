<?php

namespace App\Http\Controllers\Prototype;

//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

/**
 * Description of AbstractController
 */
class AbstractController extends BaseController
{
//    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $viewData = [];
    protected $viewName;
    protected $request;
    protected $baseUrl;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->baseUrl = url('/');

        $this->init();
    }

    public function init(){}

    public function index()
    {
        return $this->render();
    }

    public function setViewName(string $viewName): void
    {
        $this->viewName = $viewName;
    }

    public function setViewData(string $key, $data)
    {
        if (!array_key_exists($key, $this->viewData))
        {
            $this->viewData[$key] = $data;
        }
    }

    public function render()
    {
        $viewData = array_merge(
            [ 'baseUrl' => $this->baseUrl ],
            $this->viewData
        );

        return view(
            $this->viewName,
            $viewData
        );
    }

}