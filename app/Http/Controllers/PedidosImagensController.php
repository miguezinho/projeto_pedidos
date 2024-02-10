<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePedidosImagensRequest;
use App\Http\Requests\UpdatePedidosImagensRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Pedidos;
use App\Repositories\PedidosImagensRepository;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Flash;

class PedidosImagensController extends AppBaseController
{
    /** @var PedidosImagensRepository $pedidosImagensRepository*/
    private $pedidosImagensRepository;

    public function __construct(PedidosImagensRepository $pedidosImagensRepo)
    {
        $this->pedidosImagensRepository = $pedidosImagensRepo;
    }

    /**
     * Display a listing of the pedidos-imagens.
     */
    public function index(Request $request)
    {
        $pedido = Pedidos::find($request->get('pedido_id'));

        $pedidosImagens = $this->pedidosImagensRepository->paginate(10);

        return view('pedidos_imagens.index')
            ->with('pedido', $pedido)
            ->with('pedidosImagens', $pedidosImagens);
    }

    /**
     * Show the form for creating a new pedidos-imagens.
     */
    public function create(Request $request)
    {
        $pedido = Pedidos::find($request->get('pedido_id'));

        return view('pedidos_imagens.create')
            ->with('pedido', $pedido);
    }

    /**
     * Store a newly created PedidosImagens in storage.
     */
    public function store(CreatePedidosImagensRequest $request)
    {
        //Original
        $filenameWithExt = $request->file('imagem')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('imagem')->getClientOriginalExtension();
        $fileNameToStore = "pedidos_imagens/{$request->get('pedido_id')}/" . $filename . '_' . date('YmiHis') . '.' . $extension;
        $path = $request->file('imagem')->storeAs("public/", $fileNameToStore);

        //Capa
        $fileNameToStoreCapa = "pedidos_imagens/{$request->get('pedido_id')}/capas/" . $filename . '_' . date('YmiHis') . '.' . $extension;
        Image::make($request->file('imagem'))
        ->resize(90, 100)
        ->save("/storage/app/public/" . $fileNameToStoreCapa);

        $input = $request->all();
        $input['imagem'] = $fileNameToStore;
        $input['capa'] = $fileNameToStoreCapa;

        $pedidosImagens = $this->pedidosImagensRepository->create($input);

        Flash::success('Pedidos Imagens saved successfully.');

        return redirect(route('pedidos-imagens.index', ['pedido_id' => $input['pedido_id']]));
    }

    /**
     * Display the specified pedidos-imagens.
     */
    public function show($id)
    {
        $pedidosImagens = $this->pedidosImagensRepository->find($id);

        if (empty($pedidosImagens)) {
            Flash::error('Pedidos Imagens not found');

            return redirect(route('pedidos-imagens.index'));
        }

        return view('pedidos_imagens.show')->with('pedidosImagens', $pedidosImagens);
    }

    /**
     * Show the form for editing the specified pedidos-imagens.
     */
    public function edit($id)
    {
        $pedidosImagens = $this->pedidosImagensRepository->find($id);

        if (empty($pedidosImagens)) {
            Flash::error('Pedidos Imagens not found');

            return redirect(route('pedidos-imagens.index'));
        }

        return view('pedidos_imagens.edit')->with('pedidosImagens', $pedidosImagens);
    }

    /**
     * Update the specified PedidosImagens in storage.
     */
    public function update($id, UpdatePedidosImagensRequest $request)
    {
        $pedidosImagens = $this->pedidosImagensRepository->find($id);

        if (empty($pedidosImagens)) {
            Flash::error('Pedidos Imagens not found');

            return redirect(route('pedidos-imagens.index'));
        }

        $pedidosImagens = $this->pedidosImagensRepository->update($request->all(), $id);

        Flash::success('Pedidos Imagens updated successfully.');

        return redirect(route('pedidos-imagens.index'));
    }

    /**
     * Remove the specified PedidosImagens from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pedidosImagens = $this->pedidosImagensRepository->find($id);

        if (empty($pedidosImagens)) {
            Flash::error('Pedidos Imagens not found');

            return redirect(route('pedidos-imagens.index'));
        }

        $this->pedidosImagensRepository->delete($id);

        Flash::success('Pedidos Imagens deleted successfully.');

        return redirect(route('pedidos-imagens.index'));
    }
}
