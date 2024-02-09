<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePedidosRequest;
use App\Http\Requests\UpdatePedidosRequest;
use App\Http\Controllers\AppBaseController;
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
        return view('pedidos.create');
    }

    /**
     * Store a newly created Pedidos in storage.
     */
    public function store(CreatePedidosRequest $request)
    {
        $input = $request->all();

        $pedidos = $this->pedidosRepository->create($input);

        Flash::success('Pedidos saved successfully.');

        return redirect(route('pedidos.index'));
    }

    /**
     * Display the specified Pedidos.
     */
    public function show($id)
    {
        $pedidos = $this->pedidosRepository->find($id);

        if (empty($pedidos)) {
            Flash::error('Pedidos not found');

            return redirect(route('pedidos.index'));
        }

        return view('pedidos.show')->with('pedidos', $pedidos);
    }

    /**
     * Show the form for editing the specified Pedidos.
     */
    public function edit($id)
    {
        $pedidos = $this->pedidosRepository->find($id);

        if (empty($pedidos)) {
            Flash::error('Pedidos not found');

            return redirect(route('pedidos.index'));
        }

        return view('pedidos.edit')->with('pedidos', $pedidos);
    }

    /**
     * Update the specified Pedidos in storage.
     */
    public function update($id, UpdatePedidosRequest $request)
    {
        $pedidos = $this->pedidosRepository->find($id);

        if (empty($pedidos)) {
            Flash::error('Pedidos not found');

            return redirect(route('pedidos.index'));
        }

        $pedidos = $this->pedidosRepository->update($request->all(), $id);

        Flash::success('Pedidos updated successfully.');

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
            Flash::error('Pedidos not found');

            return redirect(route('pedidos.index'));
        }

        $this->pedidosRepository->delete($id);

        Flash::success('Pedidos deleted successfully.');

        return redirect(route('pedidos.index'));
    }
}
