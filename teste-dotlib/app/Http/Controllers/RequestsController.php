<?php

namespace App\Http\Controllers;

use App\Repositories\RequestRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\Request as Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RequestsController extends Controller
{
    public function __construct(UserRepository $userRepository, RequestRepository $requestRepository)
    {
        $this->userRepository = $userRepository;
        $this->requestRepository = $requestRepository;
    }

    //    busca os pedidos na ordem da data de entrega
    public function index($filter) {
        if(Session::get('user.admin')) {
            $requests = DB::table('requests')
                ->join('requests_enum as re', 'requests.status_id', '=', 're.id')
                ->select('requests.*', 're.status')
                ->orderBy($filter, 'desc')
                ->simplePaginate(20);
        } else {
            $requests = DB::table('requests')
                ->join('requests_enum as re', 'requests.status_id', '=', 're.id')
                ->select('requests.*', 're.status')
                ->where('client_id', Session::get('user.id'))
                ->orderBy($filter, 'desc')
                ->simplePaginate(20);
        }

        $clients = $this->userRepository->getClients();

        return view('requests', [
            'requests' => $requests,
            'clients' => $clients
        ]);
    }

    public function listOrdersByRequestAjax($id) {
        return $this->requestRepository->listOrdersByRequest($id);
    }


    public function store(Request $request) {
        $this->requestRepository->store($request);

        return redirect()->route('requests', 'id');
    }

    public function showAjax($id) {
        return $this->requestRepository->getRequestByIdAjax($id);
    }

    public function getRequestByUser($id) {
        return $this->requestRepository->getRequestByUserIdAjax($id);
    }

    public function addOrderInRequestAjax(Request $request) {
        return $this->requestRepository->addOrderInRequest($request);
    }

    public function destroyAjax($id) {
        $this->requestRepository->destroyRequestByIdAjax($id);
    }
}
