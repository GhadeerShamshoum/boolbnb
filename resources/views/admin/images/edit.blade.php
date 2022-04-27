@extends('layouts.app')
@section('content')  
  <div class="container">
    <div class="row">
      <div class="col-12">

        <h1>Gestisci le immagini</h1>
        @forelse($apartment->images as $image)
          <div class="ms_imgCardContainer py-3 d-flex my-4 d-flex justify-content-center align-items-center">
            <div class="ms_imgContainer ml-3 mr-3">
              <img src="{{asset( 'storage/'.$image->url )}}" alt="">
            </div>
            <form class="col-4 d-flex align-items-center mb-0" action="{{route("admin.images.update", $image->id)}}" method="POST">
              @csrf
              <label class="d-flex mr-3 mb-0" for="main_image">
                @if($image->main_image)
                  Al momento questa è l'immagine principale del tuo appartamento.
                @else
                  <button type="submit" class="ms_saveBtn ml-2 mb-0">Imposta come immagine principale</button>
                @endif
              </label>
            </form>
            
            <button data-toggle="modal" data-target="#modal-delete-{{$image->id}}" type="button" class="m-0 btn btn-secondary ms_cancelBtn" style="height: 60px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 320 512">
              <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
              Elimina
            </button>
            <div class="modal fade" id="modal-delete-{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-delete2" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            Sicuro di voler eliminare questa immagine?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annulla</button>
                            <form  action="{{ route('admin.images.destroy', $image->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button  type="submit" class="btn btn-danger ml-1 text-white" >
                                Cancella
                                </button>                                            
                            </form>
                        </div>
                    </div>
                </div>     
            </div>     
          </div>
        @empty
          Al momento non ci sono immagini.
        @endforelse  
        <h1>Aggiungi Immagini</h1>
        <form action="{{route('admin.images.store', $apartment->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group col-10 ml-2 mt-3 p-0">
            <label for="files">Inserisci delle altre immagini relative all'appartamento:</label>
            <input class="form-control col-4" type="file" id="images" name="images[]" multiple><br><br>
          </div>
          <div class="d-flex">
            <button type="submit" class="btn btn-primary ms_saveBtnD ml-4 mr-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
              </svg>
              Save
            </button>
            <a href="{{route('admin.apartments.index')}}">
              <button type="button" class="btn btn-secondary cancelBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 320 512">
                <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                Annulla
              </button>
            </a>
          </div>    
        </form>
      </div>
    </div>
  </div>  
@endsection

