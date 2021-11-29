<?php

namespace App\Http\Controllers\Site;

use App\Exceptions\FileStorageException;
use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\User;
use App\Models\Vaga;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{

    public function lista(Request $request)
    {

        $empresas = Empresa::all();

        $vagas = Vaga::with('empresa', 'tags')
        ->when(!is_null($request->search), function($query) use($request) {
            $query->where('titulo', 'LIKE', '%' . $request->search . '%')
            ->orWhere('descricao', 'LIKE', '%' . $request->search . '%')
            ->orWhere('nivel', 'LIKE', '%' . $request->search . '%')
            ->orWhere('categoria', 'LIKE', '%' . $request->search . '%')
            ->orWhere('regime', 'LIKE', '%' . $request->search . '%');
        })
        ->when(!is_null($request->empresa), function($query) use ($request){
            $query->where('empresa_id', '=', $request->empresa);
        })
        ->when(!is_null($request->order) && !is_null($request->orderType), function($query) use($request) {
            $query->orderBy($request->order, $request->orderType);
        })->paginate(!is_null($request->perpage) ? $request->perpage : 20);

        return view('home', compact('vagas', 'empresas'));
    }

    public function vaga($slug){

        try {
            $vaga = Vaga::with('empresa', 'tags')->where('slug', '=', $slug)->firstOrFail();

            if($vaga->is_paused){
                $notification = array(
                    'message' => 'Essa vaga se encontra pausada',
                    'alert-type' => 'warning'
                );

                return redirect()->back()->with($notification);
            }

            return view('vaga', compact('vaga'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            $notification = array(
                'message' => 'Vaga não encontrada',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);

        } catch( \Exception $e){
            $notification = array(
                'message' => 'Erro no Servidor',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function inscrever(Request $request, $slug){

        $candidato_id = auth()->user()->candidato->id;
        try {

            $vaga = Vaga::with('candidatos')->where('slug', '=', $slug)->firstOrFail();

            $vaga_filter = $vaga->candidatos->filter(function($inscricao){
                return $inscricao->pivot->status == "ativo";
            });

            if( in_array($candidato_id, $vaga_filter->pluck('id')->toArray()) ){

                $notification = array(
                    'message' => 'Você já está inscrito nessa vaga',
                    'alert-type' => 'warning'
                );

                return redirect()->back()->with($notification);
            }

            $vaga->candidatos()->attach($candidato_id, [
                'aplicado_em' => Carbon::now(),
                'status' => 'ativo',
                'path_curriculo' => $this->uploadCurriculo($request)
            ]);

            $notification = array(
                'message' => 'Você foi inscrito nessa vaga',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }catch (ModelNotFoundException $m){

            $notification = array(
                'message' => 'Vaga não encontrada',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } catch (FileStorageException $fs){

            $notification = array(
                'message' => 'Erro ao armazenar o arquivo',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Erro no Servidor',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }

    }

    protected function uploadCurriculo(Request $request){

        if($request->hasFile('curriculo')){
            if(!Storage::disk('curriculo')->exists(auth()->user()->candidato->nome)){
                Storage::disk('curriculo')->makeDirectory(auth()->user()->candidato->nome);
            }

            $file = $request->file('curriculo');

            $filename = $file->getClientOriginalName();
            $path = $file->storeAs(auth()->user()->candidato->nome, $filename, 'curriculo');

            return $path;
        }else{
            throw new FileStorageException("Falha ao armazenar o arquivo", 0);
        }
    }


    public function users(){
        $users = User::all();

        return view('users', compact('users'));
    }
}
