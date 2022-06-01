<div>
    

            <x-jet-dialog-modal wire:model="open">
           
              <div>    
              <x-slot name="title">
              Editar Post
             </x-slot>
              </div>

             
            <x-slot name="content" class="mb-4" >
                  
              <div class=" mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" wire:loading wire:target="imagenes" role="alert">
                  <strong class="font-bold">Imagen Cargando!</strong>
                  <span class="block sm:inline">Espere un Momento</span>
                  
                </div>
      
                  @if ($imagenes)
                  <img  class="mb-4" src="{{$imagenes->temporaryUrl()}}">    
                  @else
                      
                    <img src="{{Storage::url('$p->imagenes')}}" >
               
                  @endif
      
                
                  <div>
                <x-jet-label value="Titulo del Post"/>
                <x-jet-input class="" wire:model="p.titulo"  type="text" class="flex-1 mr-3 w-full"/>
                <x-jet-input-error for="titulo"/>
                </div>
      
                <div class="mt-3">
                <x-jet-label value="Contenido"/>
                <textarea class="resize-x rounded-md w-full mr-3" id="exampleFormControlTextarea1" rows="3"  wire:model="p.contenido"></textarea>
                <x-jet-input-error for="contenido"/>
               
               
                  <div>
                    <input type="file" wire:model="imagenes" id="{{$identificador}}">
                </div>
              
              </x-slot>
      
                <x-slot name="footer" class="mt-4">
              
                  <x-jet-secondary-button wire:click="$set('open',false)" class="">Cancelar</x-jet-button>
                  <x-jet-danger-button wire:loading.attr="disabled" wire:target="save,imagenes" wire:click="save">Editar</x-jet-button>
         
                  
              
                </x-slot>
            
            
            
            
                </x-jet-dialog-modal>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
</div>
      