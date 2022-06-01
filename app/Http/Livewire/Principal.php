<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Principal extends Component
{
use WithPagination;
   use WithFileUploads;
    public $buscar='';
    public $imagenes,$identificador,$p;
    public $cant='10';
    public $open_edit=false;// hay que definirla en los dos lados una aca la otra dentro de la funcion edit
    public $readytoload=false; // para aplazar la carga en la web
    public $sort='id';
    public $direc='asc';

    public function mount(){

    $this->idenfificador=rand();  // para limpiar el input tipo filess
        
    $this->p = new Post;

    }

protected $queryString =[   // funcion que me permite limpiar la url de datos ya sea buscando o paginando 

    'cant' => ['except' => '10'],
    'buscar' => ['except' => ''] 

];

public function updatingBuscar(){    // para resetear el buscador que no me almacene nada en la pagina que tengo cargada

    $this->resetPage();

}

 

    protected $rules=['p.titulo'=>'Required',
    'p.contenido'=>'Required'];


    protected $listeners =['render' => 'render','delete']; 

    
    public function render(Post $post)
    {

        if ($this->readytoload) {
           
            $post= Post::where('titulo','like','%'.$this->buscar.'%')
            ->orwhere('contenido','like','%'.$this->buscar.'%')
            ->orderby($this->sort,$this->direc)
            ->paginate($this->cant);
        }else {
          $post=[];
        }




        return view('livewire.principal',compact('post'));
    }


    public function loadpost(){

        $this->readytoload =true;
    }

    public function edit(Post $p){

        $this->p=$p;
        $this->open_edit=true;
        
    }

    public function save(){

        if ($this->imagenes) {

            Storage::delete([$this->p->imagenes]); // me elimina la imagen anterior
          
            $this->p->imagenes=$this->imagenes->store('public');; // me guarda la imagen nueva
        }

        $this->validate(); //validaciones
        $this->p->save();  //actualiza los datos
        $this->reset(['open_edit','imagenes']); // me resetea la variables
        $this->identificador=rand();
        $this->emitTo('principal','render'); // me renderiza la vista 
        $this->emit('alert','El post se ha Actualizado Correctamente');



    }

    //  el parametro que tengo de la funcion de javascrit me lo traigo intanciandolo luego lo ejecuto con la funcion delete
public function delete(Post $postId){

    $postId->delete();

}

//funcion para cambiar de direccion los titulos del proyecto
public function order($sort){

    if($this->sort==$sort){
    
    if($this->direc=='desc'){
        $this->direc=='asc';
    } else {
        $this->direc=='desc';
    }
        $this->sort =$sort;
    }
    }



}
