<div>
    
    </button>
    <x-jet-danger-button class="text-blue font-bold py-2 px-4 rounded-full" wire:click="$set('open',true)">Crear post</x-jet-button>

      <x-jet-dialog-modal wire:model="open">
     
        <div>    
        <x-slot name="title">
          Crear nuevo Post
       </x-slot>
        </div>
      
      <x-slot name="content" class="mb-4" >
            
        <div class=" mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" wire:loading wire:target="imagenes" role="alert">
            <strong class="font-bold">Imagen Cargando!</strong>
            <span class="block sm:inline">Espere un Momento</span>
            
          </div>


            @if ($imagenes)
            <img  class="mb-4" src="{{$imagenes->temporaryUrl()}}">
           
            @endif

          
            <div>
          <x-jet-label value="Titulo del Post"/>
          <x-jet-input class="" wire:model="titulo"  type="text" class="flex-1 mr-3 w-full"/>
          <x-jet-input-error for="titulo"/>
          </div>
            
                 {{-- wire ignore ignora todo el modal pero no se ejecuta las funciones--}}
          <div class="mt-3" wire:ignore>
          <x-jet-label value="Contenido"/>
          <textarea class="resize-x rounded-md w-full mr-3" id="editor" rows="3"  wire:model="contenido"></textarea>
          <x-jet-input-error for="contenido"/>
         </div>
         
            <div>
              <input type="file" wire:model="imagenes" id="{{$identificador}}">
          </div>
        
        </x-slot>

          <x-slot name="footer" class="mt-4">
        
            <x-jet-secondary-button wire:click="$set('open',false)" class="">Cancelar</x-jet-button>
            <x-jet-danger-button wire:loading.attr="disabled" wire:target="save" wire:click="save">Crear</x-jet-button>
   
            
        
          </x-slot>
      
      
      
      
          </x-jet-dialog-modal>


          @push('js')
          <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
          
          
          <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then(function(editor){
                editor.model.document.on('change:data', ()=> {  //cada vez que haya un cambio en el editor,que cambiemos algo se desencadene una accion
                    @this.set('contenido',editor.getData());    //sirve para que el se ejecute el tex-area con cke-editor
                })
                livewire.on('resetCKEditor',()=>{  // resetea el text area ya que estaba ignorado 
                   editor.setData('') })
              
              })
                .catch( error => {
                    console.error( error );
                } );
        </script>
          
          @endpush













</div>
