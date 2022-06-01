<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads; //para subir imagenes , archivos

class Crear extends Component
{
    use WithFileUploads;


    public $open = false;
    public $titulo ,$contenido;
    public $imagenes,$identificador;

    protected $rules = ['titulo' => 'required|max:10',
                     'contenido' => 'required|max:100',
                     'imagenes' => 'image|max:2048'];
    
 //cada vez que modifiquemos el valor de una propiedad se ejecute el metodo y verifica y cumple las reglas de verificacion que coloque
   
public function mount() {              //funcion mount es la primera funcion que se ejecuta
  $this->identificador = rand();

}

 public function save(){

    $this->validate();

    $imagenes=$this->imagenes->store('public');
    
   
   post::create([ 'titulo' =>$this->titulo,
                  'contenido' =>$this->contenido,
                'imagenes'=> $imagenes]);

   $this->reset(['open','titulo','contenido','imagenes']);
   $this->identificador=rand();
   $this->emitTo('principal','render');
   $this->emit('alert','El post se ha Creado');
                   
 }           


 public function render()
 {

 return view('livewire.crear');}


public function updatingOpen(){  //updating actualiza las funciones antes de hacer un cambio

  if($this->open==false){
  $this->reset(['titulo','contenido','imagenes']);
  $this->identificador=rand();
  $this->emit('resetCKEditor'); // necesito emitirlo ya que el text-area queda ignorado por el ckeditor que escuche el evento para resetear los valores y quede el modal limpio
}
}




}