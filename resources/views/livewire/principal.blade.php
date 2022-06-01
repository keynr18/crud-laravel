<div wire:init="loadpost">   {{-- wire:init me inicia la funcion readytoload para aplazar el estado de carga de la web--}}
         <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="relative mt-6 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

        
   <div class="flex items-center flex-1 px-6 py-4">

      <div id="uno" wire:model="cant" class="px-6 py-3 ">
      <span>Mostrar</span>
        <select class="mx-2" name="" id="">
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>

        </select>

        <span>Entradas</span>
      </div>

      <x-jet-input wire:model="buscar" type="text" class="flex-1 mr-3" /> 
      @livewire('crear')  
      </div>
      <tr>
       <th class="" scope="col" class="px-6 py-3" wire:click="order('id')">
         #
        </th>
        <th scope="col" class="px-6 py-3" wire:click="order('titulo')">
        Titulo
        </th>
        <th scope="col" class="px-6 py-3" wire:click="order('contenido')">
        Contenido
        </th>
        <th scope="col" class="px-6 py-3">
        <span class="sr-only">Edit</span>
        </th>
        </tr>
        </thead>
        <tbody>
         @foreach ($post as $p)
             
         
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
        {{$p->id}}
        </th>
        <td class="px-6 py-4">
            {{$p->titulo}}
        </td>
        <td class="px-6 py-4"> 
        {!!$p->contenido!!}  {{-- los signos de exclamacion sirven para que no se interprete el codigo en html si no que lo interprete de buena manera --}}
        </td>
    
        <td class="flex px-6 py-4 ">
        {{-- @livewire('editar', ['p' => $p], key($p->id))--}}
        
          <x-jet-button class="px-4 py-2 font-bold rounded-full text-blue" ><a   wire:click="edit({{$p}})">Edit</a ></x-jet-button>
          <x-jet-button class="px-4 py-2 ml-2 font-bold rounded-full text-blue" ><a  wire:click="$emit('deletePost',{{$p->id}})">Delete</a ></x-jet-button>
        
        </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        </tr>

        @endforeach       
      
      </tbody>
      <div>
        {{-- no existen archivos crear condicional aqui--}}
      </div>
   
     
    {{--  @if ($post->hasPages())  condicional que muestra si el div si tiene al menos dos paginas si no , lo mantiene oculto--}}
    {{-- <div class="px-6 py-3">--}}
      {{--  $post->links()}} {{-- paginacion--}}
    {{--   @endif--}}
   {{--  </div>--}}
     
     
    </table>
    
       
      <x-jet-dialog-modal wire:model="open_edit">
           
          <div>    
            <x-slot name="title">
             Editar Post
            </x-slot>
          </div>

         
         <x-slot name="content" class="mb-4" >
              
          <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded " wire:loading wire:target="imagenes" role="alert">
              <strong class="font-bold">Imagen Cargando!</strong>
              <span class="block sm:inline">Espere un Momento</span>
              
            </div>
  
              @if($imagenes)
              
              <img  class="mb-4" src="{{$imagenes->temporaryUrl()}}">    
            
              {{--@elseif($p->imagenes)
               
              <img src="{{Storage::url($p->imagenes)}}">
              {{$p->id}}
             {{-- <img src="{{asset('storage/'.$p->imagenes.'') }}"> --}}
             @endif
           
              <div>

              

            <x-jet-label value="Titulo del Post"/>
            <x-jet-input class="" wire:model="p.titulo"  type="text" class="flex-1 w-full mr-3"/>
            <x-jet-input-error for="titulo"/>
            </div>
           
            <div class="mt-3">
            <x-jet-label value="Contenido"/>
            <textarea class="w-full mr-3 rounded-md resize-x"  rows="3"  wire:model="p.contenido"></textarea>
            <x-jet-input-error for="contenido"/>
            <div>
             
                <input type="file" wire:model="imagenes" id="{{$identificador}}">
            </div>
          
          </x-slot>
  
            <x-slot name="footer" class="mt-4">
          
              <x-jet-secondary-button wire:click="$set('open_edit',false)" class="">Cancelar</x-jet-button>
              <x-jet-danger-button wire:loading.attr="disabled" wire:target="save,imagenes" wire:click="save">Editar</x-jet-button>
                
              
          
            </x-slot>
        
        
        
        
      </x-jet-dialog-modal>
  




           </div>
            
@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="jquery.min.js"></script>
<script src="bootstrap-tour-standalone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.12.0/js/bootstrap-tour.min.js"></script>
<script>

//liveware.on para escuchar el evento emitido en delete + nombre de la emicion y la variable que estoy pasando mas la funcion 
 livewire.on('deletePost', postId => {

  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Estas seguro de Eliminar?',
  text: "No podras Revertirlo!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Si, Eliminar!',
  cancelButtonText: 'No, cancelar!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {

    // llamo a mi clase donde voy a escuchar , paso la funcion que voy a crear y la id 
    livewire.emitTo('principal','delete',postId);

    swalWithBootstrapButtons.fire(
      'Deleted!',
      'Tu Post ha sido Eliminado.',
      'success'
    )
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelado',
      'Tu Pos Esta a salvo:)',
      'error'
    )
  }
})
$(document).ready(function(){
    
  var tour = new Tour({
  steps: [
  {
    element: "#uno",
    title: "Title of my step",
    content: "Content of my step"
  },
  {
    element: "#my-other-element",
    title: "Title of my step",
    content: "Content of my step"
  }
]});

// Initialize the tour
tour.init();

// Start the tour
tour.start();
    
  }); 




 })

</script>

@endpush


</div>























</div>
