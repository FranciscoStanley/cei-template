<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use Illuminate\Support\Facades\Storage;
class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $curriculum = Curriculum::where('matricula', $request->matricula)->get();
        if(isset( $curriculum[0])){
            return Response()->json([
                'id' => $curriculum[0]->id, 
                'name' => $curriculum[0]->name, 
                'email'=> $curriculum[0]->email,
                'matricula'=> $curriculum[0]->matricula,
                'curso'=> $curriculum[0]->matricula,
                'curriculum'=> env('APP_URL').$curriculum[0]->arquivo,
                'status'=>$curriculum[0]->status
                ]);
        }else{
            return Respose()->json(['error' =>'Perfil não encontrado']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // Define o valor default para a variável que contém o nome da imagem 
    $nameFile = null;
 
    // Verifica se informou o arquivo e se é válido
    if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
         
        // Define um aleatório para o arquivo baseado no timestamps atual
        $name = uniqid(date('HisYmd'));
 
        // Recupera a extensão do arquivo
        $extension = $request->arquivo->extension();
 
        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";
 
        // Faz o upload:
        $upload = $request->arquivo->storeAs('/public/curriculum', $nameFile);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        $curriculum = Curriculum::where('matricula', $request->matricula)->get();
        if(isset($curriculum[0])){
            $curriculum[0]->name = $request->name;
            $curriculum[0]->email = $request->email;
            $curriculum[0]->matricula = $request->matricula;
            $curriculum[0]->curso = $request->curso;
            $curriculum[0]->arquivo = Storage::url('curriculum/'.$nameFile);
            $curriculum[0]->update();
        }else{
            $curriculum = new Curriculum;
            $curriculum->name = $request->name;
            $curriculum->email = $request->email;
            $curriculum->matricula = $request->matricula;
            $curriculum->curso = $request->curso;
            $curriculum->arquivo = Storage::url('curriculum/'.$nameFile);
            $curriculum->save();
        }
        // Verifica se NÃO deu certo o upload (Redireciona de volta)
        if ( !$upload ){
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();
        }
        return redirect()->back()->with('success', 'Recebemos seu curriculum');

 
     }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function curriculuns()
    {
        $curriculum = Curriculum::all();
        

        return view('curriculum.index', compact('curriculum'));
    }
    public function aprovar(Request $request)
    {
        if(auth()->user()->id){
            $curriculum = Curriculum::find($request->id);
            $curriculum->status =1;
            $curriculum->save();
    
            return Redirect()->back();
        }
    }
    public function reprovar(Request $request)
    {
        if(auth()->user()->id){
            $curriculum = Curriculum::find($request->id);
            $curriculum->status =2;
            $curriculum->save();
    
            return Redirect()->back();
        }
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
