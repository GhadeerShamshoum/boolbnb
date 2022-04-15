@extends('layouts.app')

@section('content')
<h1 class="text-center">Inserire un nuovo appartamento </h1>
<form action="{{route('admin.apartments.store')}}" method="POST" enctype="multipart/form-data">
  @csrf

  <!-- name -->
  <div class="form-group col-md-12">
    <label for="name">Nome</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="aggiungi nome dell'appartamento" value="{{old("name")}}">
    @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <!-- description -->
  <div class="form-group col-md-12">
    <label for="description">Descrizione</label>
    <input type="textarea" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="aggiungi descrizione dell'appartamento" value="{{old("description")}}">
    @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

   <!-- number of rooms -->
   <div class="form-group col-md-12">
    <label for="rooms">Numero di stanze</label>
    <input type="number" id="rooms" name="rooms"
            min="1" max="99"
            value="{{old("rooms")}}"
            class="form-control @error('rooms') is-invalid @enderror">

    @error('rooms')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

   <!-- Letti -->
  <div class="form-group col-md-12">
      <label for="beds">Letti</label>
      <input type="number" id="beds" name="beds"
              min="1" max="99"
              value="{{old("beds")}}"
              class="form-control @error('beds') is-invalid @enderror">

      @error('beds')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
  </div>

   <!-- Bagni -->
   <div class="form-group col-md-12">
      <label for="bathrooms">Bagni</label>
      <input type="number" id="bathrooms" name="bathrooms"
              min="1" max="99"
              value="{{old("bathrooms")}}"
              class="form-control @error('bathrooms') is-invalid @enderror">

      @error('bathrooms')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
  </div>

   <!-- metri quadrati -->
  <div class="form-group col-md-12">
      <label for="square_meters">Metri quadrati</label>
      <input type="number" id="square_meters" name="square_meters"
              min="1" max="999"
              value="{{old("square_meters")}}"
              class="form-control @error('square_meters') is-invalid @enderror">

      @error('square_meters')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
  </div>

  <!-- address -->
  <div class="form-group col-md-12">
    <label for="address">Indirizzo completo</label>
    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="aggiungi l'indirizzo completo" value="{{old("address")}}">
    @error('address')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  {{-- visible --}}
  <div class="form-check">
    <label class="form-check-label" for="visible">
      Visibile
    </label>
    <input class="form-check-input" type="checkbox" name="visible" id="visible"
    value="visible"
    {{old("visible") ? "checked" : ""}}
    >  
  </div>

  <!-- images -->
  <div class="form-group">
    <label for="">Immagini</label>
    <input type="file" name="image"
    class="form-control @error('image') is-invalid @enderror"
    >
    @error('image')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">  
    <label for="">Immagini</label>
    <input type="file" name="image[]"
    class="form-control @error('image') is-invalid @enderror"
    >
    @error('image')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="">Immagini</label>
    <input type="file" name="image"
    class="form-control @error('image') is-invalid @enderror"
    >
    @error('image')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="">Immagini</label>
    <input type="file" name="image"
    class="form-control @error('image') is-invalid @enderror"
    >
    @error('image')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="">Immagini</label>
    <input type="file" name="image"
    class="form-control @error('image') is-invalid @enderror"
    >
    @error('image')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>


  <!-- services -->
  <div class="form-group">
      <label>Servizi</label>
      @foreach ($services as $service)
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="services[]" id="{{$service->slug}}"
          value="{{$service->id}}"
          {{old("services") && in_array($service->id, old('services')) ? "checked" : ""}}
          >
          <label class="form-check-label" for="{{$service->id}}">
            {{$service->name}}
          </label>  
        </div>
      @endforeach
  </div>

  <button type="submit" class="btn btn-primary">Add</button>
</form>


@endsection 