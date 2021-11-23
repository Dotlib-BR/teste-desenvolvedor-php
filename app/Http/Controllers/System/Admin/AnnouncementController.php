<?php

namespace App\Http\Controllers\System\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Announcement;
use App\Models\Company;
use Illuminate\Http\Request;
use DB;

class AnnouncementController extends Controller
{
    private $announcement;
    private $company;

    public function __construct(Announcement $announcement, Company $company)
    {
        $this->announcement = $announcement;
        $this->company = $company;
    }

    public function index()
    {
        $title = 'Anuncios Cadastrados no Sistema ADM';
        $description = 'Lista de Anúncios ADM';
        $adm = 1;
        $announcements =$this->announcement->get();
        return view('annuncement.listing.index', compact('title','description','announcements','adm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title= 'Formulário para cadastrar anúncio';
        $description= 'Formulário para cadastrar anúncio';
        $companies = $this->company->get();
        $active = ['0'=>'Pausado','1'=>'Ativo'];
        $tipo_contrato = array('CLT'=>'CLT', 'Legal person'=>'Pessoa Jurídica', 'Freelancer'=>'Freelancer');
        return view('annuncement.forms.index',compact('title','description','companies', 'tipo_contrato', 'active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'company_id' => 'required',
            'title' => 'required|min:5|max:50',
            'description' => 'required|min:10|max:1000',
            'remuneration' => 'required|numeric|between:1000, 500000',
            'vacancy_type' => 'required',
            'active' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'company_id.required' => 'O campo empresa é obrigatório',
            'remuneracao.required' => 'O campo salário é obrigatório',
            'vacancy_type.required' => 'O campo tipo de contrato é obrigatório',
            'title.min' => 'O título deve ter no mínimo 3 caracteres',
            'title.max' => 'O título deve ter no maxímo 50 caracteres',
            'description.min' => 'A descrição deve ter no mínimo 10 caracteres',
            'description.max' => 'A descrição deve ter no maxímo 1000 caracteres',
            'remuneration.numeric' => 'O campo :attribute deve ser do tipo numérico',
            'remuneration.between'=>'São valídos apenas valores entre 1000 a 500000'
        ];

        $validation = $this->validation($data, $rules, $feedback);

        if ($validation->fails()) {
            return redirect()->route('announcement.adm.create')
                ->withErrors($validation)
                ->withInput();
        }

        $announcement = $this->announcement->create($request->all());
        if($announcement){
            return redirect()->back()->with('msg', 'Anúncio cadastrado com sucesso!');
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title= 'Formulário para editar anúncio';
        $description= 'Formulário para editar anúncio';
        $announcement = $this->announcement->find($id);
        $companies = $this->company->get();
        $active = ['0'=>'Pausado','1'=>'Ativo'];
        $tipo_contrato = array('CLT'=>'CLT', 'Legal person'=>'Pessoa Jurídica', 'Freelancer'=>'Freelancer');
        return view('annuncement.forms.index',compact('title','description','companies', 'tipo_contrato', 'announcement','active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $announcement = $this->announcement->find($request->id);
        $rules = [
            'company_id' => 'required',
            'title' => 'required|min:5|max:50',
            'description' => 'required|min:10|max:1000',
            'remuneration' => 'required|numeric|between:1000, 500000',
            'vacancy_type' => 'required',
            'active' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'company_id.required' => 'O campo empresa é obrigatório',
            'remuneracao.required' => 'O campo salário é obrigatório',
            'vacancy_type.required' => 'O campo tipo de contrato é obrigatório',
            'title.min' => 'O título deve ter no mínimo 3 caracteres',
            'title.max' => 'O título deve ter no maxímo 50 caracteres',
            'description.min' => 'A descrição deve ter no mínimo 10 caracteres',
            'description.max' => 'A descrição deve ter no maxímo 1000 caracteres',
            'remuneration.numeric' => 'O campo :attribute deve ser do tipo numérico',
            'remuneration.between'=>'São valídos apenas valores entre 1000 a 500000'
        ];
        $validation = $this->validation($request->all(), $rules, $feedback);

        if ($validation->fails()) {
            return redirect()->route('announcement.adm.edit', [$announcement->id])
                ->withErrors($validation)
                ->withInput();
        }
        $update = $announcement->update($request->all());
        if($update){
            return redirect()->route('announcement.adm.edit',[$announcement->id])->with('msg', 'Anúncio cadastrado com sucesso!');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = $this->announcement->find($id);
        $announcement->delete();
        return redirect()->back()->with('msg','Anúncio apagado com sucesso!');
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
                 if ($flag) {
                     $sql .= " WHERE a.id IN ($arrayImplode)";
                 } else {
                     $sql .= " WHERE a.id NOT IN ($arrayImplode)";
                 }
             }

             $adverts=\DB::select($sql);
         }
         return $adverts;
     }

     public function deleteForAll(Request $request)
     {
        $this->announcement->whereIn('id', $request->checkbox_value)->delete();
        return response()->json(['msg'=>'ok'], 200);
     }

     protected function validation(array $data, array $rules, array $feedback)
     {
         return Validator::make($data, $rules, $feedback);
     }

}
