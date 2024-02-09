<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientesRequest;
use App\Http\Requests\UpdateClientesRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ClientesRepository;
use Illuminate\Http\Request;
use Flash;

class ClientesController extends AppBaseController
{
    /** @var ClientesRepository $clientesRepository*/
    private $clientesRepository;

    public function __construct(ClientesRepository $clientesRepo)
    {
        $this->clientesRepository = $clientesRepo;
    }

    /**
     * Display a listing of the Clientes.
     */
    public function index(Request $request)
    {
        $clientes = $this->clientesRepository->paginate(10);

        return view('clientes.index')
            ->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new Clientes.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created Clientes in storage.
     */
    public function store(CreateClientesRequest $request)
    {
        $input = $request->all();

        $clientes = $this->clientesRepository->create($input);

        Flash::success('Clientes saved successfully.');

        return redirect(route('clientes.index'));
    }

    /**
     * Display the specified Clientes.
     */
    public function show($id)
    {
        $clientes = $this->clientesRepository->find($id);

        if (empty($clientes)) {
            Flash::error('Clientes not found');

            return redirect(route('clientes.index'));
        }

        return view('clientes.show')->with('clientes', $clientes);
    }

    /**
     * Show the form for editing the specified Clientes.
     */
    public function edit($id)
    {
        $clientes = $this->clientesRepository->find($id);

        if (empty($clientes)) {
            Flash::error('Clientes not found');

            return redirect(route('clientes.index'));
        }

        return view('clientes.edit')->with('clientes', $clientes);
    }

    /**
     * Update the specified Clientes in storage.
     */
    public function update($id, UpdateClientesRequest $request)
    {
        $clientes = $this->clientesRepository->find($id);

        if (empty($clientes)) {
            Flash::error('Clientes not found');

            return redirect(route('clientes.index'));
        }

        $clientes = $this->clientesRepository->update($request->all(), $id);

        Flash::success('Clientes updated successfully.');

        return redirect(route('clientes.index'));
    }

    /**
     * Remove the specified Clientes from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clientes = $this->clientesRepository->find($id);

        if (empty($clientes)) {
            Flash::error('Clientes not found');

            return redirect(route('clientes.index'));
        }

        $this->clientesRepository->delete($id);

        Flash::success('Clientes deleted successfully.');

        return redirect(route('clientes.index'));
    }
}
