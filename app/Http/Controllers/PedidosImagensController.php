<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePedidosImagensRequest;
use App\Http\Requests\UpdatePedidosImagensRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Pedidos;
use App\Repositories\PedidosImagensRepository;
use Illuminate\Http\Request;
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
        $filenameWithExt = $request->file('imagem')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('imagem')->getClientOriginalExtension();
        if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
            return response()->json(["errors" => ['imagem' => "Somente permitido imagens JPG e PNG!"]], 422);
        }

        //Original
        $fileNameToStore = "pedidos_imagens/{$request->get('pedido_id')}/" . $filename . '_' . date('YmiHis') . '.' . $extension;
        $path = $request->file('imagem')->storeAs("public/", $fileNameToStore);

        //Capa
        $fileNameToStoreCapa = "pedidos_imagens/{$request->get('pedido_id')}/capas/" . $filename . '_' . date('YmiHis') . '.' . $extension;
        $this->redimensionarImagem(base_path() . "/storage/app/public/" . $fileNameToStore, 90, 100, base_path() . "/storage/app/public/" . $fileNameToStoreCapa);


        $input = $request->all();
        $input['imagem'] = $fileNameToStore;
        $input['capa'] = $fileNameToStoreCapa;

        $pedidosImagens = $this->pedidosImagensRepository->create($input);

        Flash::success('Imagem cadastrada com sucesso!.');

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

    /**
     * Redimensiona uma imagem para uma nova largura e altura e a salva.
     *
     * @param string $imagemOriginal O caminho para a imagem original.
     * @param int $larguraNova A nova largura desejada para a imagem redimensionada.
     * @param int $alturaNova A nova altura desejada para a imagem redimensionada.
     * @param string $nomeNovo O nome do arquivo para a imagem redimensionada.
     * @return bool Retorna true se a imagem foi redimensionada e salva com sucesso, ou false caso contrário.
     */
    private function redimensionarImagem($imagemOriginal, $larguraNova, $alturaNova, $nomeNovo)
    {
        // Obtém as informações da imagem original
        $infoImagem = getimagesize($imagemOriginal);
        $larguraOriginal = $infoImagem[0];
        $alturaOriginal = $infoImagem[1];
        $tipoImagem = $infoImagem[2];

        // Cria uma imagem baseada no tipo da imagem original
        switch ($tipoImagem) {
            case IMAGETYPE_JPEG:
                $imagem = imagecreatefromjpeg($imagemOriginal);
                break;
            case IMAGETYPE_PNG:
                $imagem = imagecreatefrompng($imagemOriginal);
                break;
            case IMAGETYPE_GIF:
                $imagem = imagecreatefromgif($imagemOriginal);
                break;
            default:
                return false; // Tipo de imagem não suportado
        }

        // Cria uma nova imagem com as dimensões desejadas
        $novaImagem = imagecreatetruecolor($larguraNova, $alturaNova);

        // Redimensiona a imagem original para a nova imagem
        imagecopyresampled($novaImagem, $imagem, 0, 0, 0, 0, $larguraNova, $alturaNova, $larguraOriginal, $alturaOriginal);

        // Salva a nova imagem
        switch ($tipoImagem) {
            case IMAGETYPE_JPEG:
                imagejpeg($novaImagem, $nomeNovo, 100); // Qualidade 100 (melhor qualidade)
                break;
            case IMAGETYPE_PNG:
                imagepng($novaImagem, $nomeNovo, 9); // Compressão 9 (melhor compressão)
                break;
        }

        // Libera a memória
        imagedestroy($imagem);
        imagedestroy($novaImagem);

        return true;
    }

}
