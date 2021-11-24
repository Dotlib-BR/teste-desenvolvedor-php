<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\VacancyLink;
use Illuminate\Http\Request;
use DB;

class AnnouncementController extends Controller
{
    private $announcement;
    private $vacancyLink;

    public function __construct(Announcement $announcement, VacancyLink $vacancyLink)
    {
        $this->announcement = $announcement;
        $this->vacancyLink = $vacancyLink;
    }

    public function index()
    {
        $title = 'Anuncios Cadastrados no Sistema';
        $description = 'Lista de Anúncios';
        $announcements =$this->adverts(auth()->user()->id);
        return view('annuncement.listing.index', compact('title','description','announcements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $announcement_id = $request->announcement_id;
        $user_id = $request->user_id;
        $query = $this->vacancyLink
        ->where('user_id', '=', $user_id)
        ->where('announcement_id', '=', $announcement_id)
        ->get();

        if ($query->count()==0) {
                $this->vacancyLink->create([
                    'user_id' => $user_id,
                    'announcement_id' => $announcement_id
                ]);
            return redirect()->route('announcement.index')->with('linked_vacancy', 'Usuário cadastrado a vaga com sucesso');
        } else {
            return redirect()->back()->with('vacancy_already_attached', 'Usuário já esta cadastrado nesta vaga');
        }
    }

    public function show($id)
    {
        $title = 'Visualizar Vaga';
        $description = 'Cadastrar-se a vaga';
        $announcement = $this->announcement->find($id);
        return view('annuncement.compete.index',compact('title', 'announcement','description'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('vacancy_links')
            ->where('announcement_id', $request->id)
            ->delete();
        return redirect()->back()->with('user_delete', 'Você desistiu da vaga');
    }

    public function myVacancies()
    {
        $title = 'Minhas Vagas';
        $description = "Tela com as minhas vagas cadastradas";
        $annuncement = $this->adverts(auth()->user()->id, $flag=1);
        return view('annuncement.bonds.index', compact('title','description','annuncement'));
    }
    //FUNCAO PRIVADA QUE RETORNO OS TODOS OS ANÚNCIO OU OS ANÚNCIOS VINCULADOS A ALGUM USUARIO
    private function adverts($id, $flag='')
    {
         $anuncioVinculoArray = [];
         $adverts=DB::table('announcements AS a')
         ->join('vacancy_links AS vl','a.id','=','vl.announcement_id')
         ->where('vl.user_id','=',$id)
         ->select('a.id')->get(4);

         foreach($adverts as $vinculos){
             $anuncioVinculoArray[] = $vinculos->id;
         }
         if($anuncioVinculoArray==[] && $flag!==1){
             $adverts=$this->announcement->with('company')->get();
            } else {
                $sql = '';
                if ($flag == 1) {
                    $sql .= "SELECT a.id AS id,
                     a.title AS title,
                     a.description AS description,
                     a.remuneration AS remuneration,
                     a.vacancy_type AS vacancy_type,
                     a.active as active,
                     a.created_at AS created_at,
                     c.name AS company_name
                     FROM announcements AS a
                     LEFT JOIN vacancy_links AS vl ON a.id = vl.announcement_id
                     INNER JOIN companies AS c ON a.company_id=c.id WHERE vl.user_id={$id}";
             } else {
                 $arrayImplode = implode(',',  $anuncioVinculoArray);
                 $sql .= "SELECT a.id AS id,
                 a.title AS title,
                 a.description AS description,
                 a.remuneration AS remuneration,
                 a.vacancy_type AS vacancy_type,
                 a.active as active,
                 a.created_at AS created_at,
                 c.name AS company_name
                 FROM announcements AS a
                 LEFT JOIN vacancy_links AS vl ON a.id = vl.announcement_id
                 INNER JOIN companies AS c ON a.company_id=c.id";
                     $sql .= " WHERE a.id NOT IN ($arrayImplode)";
                /* if ($flag) {
                     $sql .= " WHERE a.id IN ($arrayImplode)";
                 } else {
                 }*/
             }

             $adverts=\DB::select($sql);
         }
         return $adverts;
     }

}
