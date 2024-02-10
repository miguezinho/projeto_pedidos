<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePedidosRequest;
use App\Http\Requests\UpdatePedidosRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Clientes;
use App\Models\PedidoStatus;
use App\Repositories\PedidosRepository;
use Illuminate\Http\Request;
use Flash;

class PedidosController extends AppBaseController
{
    /** @var PedidosRepository $pedidosRepository*/
    private $pedidosRepository;

    public function __construct(PedidosRepository $pedidosRepo)
    {
        $this->pedidosRepository = $pedidosRepo;
    }

    /**
     * Display a listing of the Pedidos.
     */
    public function index(Request $request)
    {
        $pedidos = $this->pedidosRepository->paginate(10);

        return view('pedidos.index')
            ->with('pedidos', $pedidos);
    }

    /**
     * Show the form for creating a new Pedidos.
     */
    public function create()
    {
        $clientes = Clientes::where("ativo", "1")->get();
        $arrClientes[''] = "Selecione";
        foreach ($clientes as $cliente) {
            $arrClientes[$cliente->id] = $cliente->nome;
        }

        $pedido_status = PedidoStatus::all();
        $arrPedidoStatus = [];
        foreach ($pedido_status as $status) {
            $arrPedidoStatus[$status->id] = $status->descricao;
        }

        return view('pedidos.create')->with("clientes", $arrClientes)->with("pedido_status", $arrPedidoStatus);
    }

    /**
     * Store a newly created Pedidos in storage.
     */
    public function store(CreatePedidosRequest $request)
    {
        $input = $request->all();

        $pedidos = $this->pedidosRepository->create($input);

        Flash::success('Pedido cadastrado com sucesso!');

        return redirect(route('pedidos.index'));
    }

    /**
     * Display the specified Pedidos.
     */
    public function show($id)
    {
        $pedidos = $this->pedidosRepository->find($id);

        if (empty($pedidos)) {
            Flash::error('Pedido não encontrado!');

            return redirect(route('pedidos.index'));
        }

        return view('pedidos.show')->with('pedidos', $pedidos);
    }

    /**
     * Show the form for editing the specified Pedidos.
     */
    public function edit($id)
    {
        $clientes = Clientes::where("ativo", "1")->get();
        $arrClientes[''] = "Selecione";
        foreach ($clientes as $cliente) {
            $arrClientes[$cliente->id] = $cliente->nome;
        }

        $pedido_status = PedidoStatus::all();
        $arrPedidoStatus = [];
        foreach ($pedido_status as $status) {
            $arrPedidoStatus[$status->id] = $status->descricao;
        }

        $pedidos = $this->pedidosRepository->find($id);

        if (empty($pedidos)) {
            Flash::error('Pedido não encontrado');

            return redirect(route('pedidos.index'));
        }

        return view('pedidos.edit')->with('pedidos', $pedidos)->with("clientes", $arrClientes)->with("pedido_status", $arrPedidoStatus);;
    }

    /**
     * Update the specified Pedidos in storage.
     */
    public function update($id, UpdatePedidosRequest $request)
    {
        $pedidos = $this->pedidosRepository->find($id);

        if (empty($pedidos)) {
            Flash::error('Pedido não encontrado');

            return redirect(route('pedidos.index'));
        }

        $pedidos = $this->pedidosRepository->update($request->all(), $id);

        Flash::success('Pedido editado com sucesso!');

        return redirect(route('pedidos.index'));
    }

    /**
     * Remove the specified Pedidos from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pedidos = $this->pedidosRepository->find($id);

        if (empty($pedidos)) {
            Flash::error('Pedido não encontrado');

            return redirect(route('pedidos.index'));
        }

        $this->pedidosRepository->delete($id);

        Flash::success('Pedido deletado com sucesso!');

        return redirect(route('pedidos.index'));
    }
}
