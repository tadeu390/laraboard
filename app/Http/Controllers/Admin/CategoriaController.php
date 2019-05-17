<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;
use App\Http\Controllers\Controller;
use App\Services\CategoriaService;

class CategoriaController extends Controller
{
    protected $service;

    public function __construct(CategoriaService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = $this->service->index();

        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\CategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        //O QUERY BUILDER DO LARAVEL NÃO LEVA EM CONSIDERAÇÃO O FIILABLE PARA
        //DETERMINAR QUAIS CAMPOS da variavel request devem ser gravados no banco,
        //PORTANTO É NECESSÁRIO ESPECÍFICAR CAMPO A CAMPO.
        $this->service->store([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
        ]);

        return redirect()
                ->route('categorias.index')
                ->withSuccess('Cadastro realizado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = $this->service->show($id);

        if (!$categoria) {
            return redirect()->back();
        }

        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = $this->service->edit($id);

        if (!$categoria) {
            return redirect()->back();
        }

        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\CategoriaRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        $this->service->update($id, $request->all());

        return redirect()
                ->route('categorias.index')
                ->withSuccess('Cadastro atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = $this->service->delete($id);

        if (!$service->success) {
            return redirect()->route('categorias.index')
                ->withDanger($service->message);
        }

        return redirect()->route('categorias.index')->withSuccess($service->message);
    }

    /**
     * Filtra os dados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        /* $categorias = DB::table('categorias')
                    ->where('title', $request->search)
                    ->orWhere('url', $request->search)
                    ->orWhere('description', 'like', "%{$request->search}%")
                    ->get(); */

        $data = (object) $request->except('_token');
        $categorias = $this->service->search($data);
        $data = (array) $data;

        return view('admin.categorias.index', compact('categorias', 'data'));
    }
}
