<?php

namespace App\Http\Livewire;
use App\Models\Post;
use Illuminate\Support\Facades\Facade;
use Livewire\Component;
use Symfony\Contracts\Service\Attribute\Required;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class Editar extends Component
{

    use WithFileUploads;

    public $open=false;
    public $p;
    public $identificador;
    public $imagenes;

    protected $rules=['p.titulo'=>'Required',
                      'p.contenido'=>'Required'];

    public function mount(Post $p){

        $this->p = $p;
        $this->identificador=rand();

    }

    // funcion hecha para actualizar 
    public function save(){

        if ($this->imagenes) {
            Storage::delete([$this->p->imagenes]); // me elimina la imagen anterior
          
            $this->p->imagenes=$this->imagenes->store('public');; // me guarda la imagen nueva
        }

        $this->validate(); //validaciones
        $this->p->save();  //actualiza los datos
        $this->reset(['open','imagenes']); // me resetea la variables
        $this->identificador=rand();
        $this->emitTo('principal','render'); // me renderiza la vista 
        $this->emit('alert','El post se ha Actualizado Correctamente');

    }



    public function render()
    {
        return view('livewire.editar');
    }
}
