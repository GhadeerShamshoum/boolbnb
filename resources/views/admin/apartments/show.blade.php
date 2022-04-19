@extends('layouts.app')

@section('content')
<div class="container showContainer">

    <h1 class="text-center my-5">{{ $apartment->name }}</h1>
    <ul>
        <li class="borderline">{{ $apartment->description }}</li>
        <div class="d-flex borderline">
            <li class="list-unstyled mr-3">
                <div class="infoContainer d-flex flex-column ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 640 512">
                    <path d="M96 318.3v1.689h1.689C97.12 319.4 96.56 318.9 96 318.3zM176 320c44.13 0 80-35.88 80-79.1s-35.88-79.1-80-79.1S96 195.9 96 240S131.9 320 176 320zM256 318.3C255.4 318.9 254.9 319.4 254.3 320H256V318.3zM544 160h-82.1L450.7 183.9C441.5 203.2 421.8 215.8 400 216c-21.23 0-40.97-12.31-50.3-31.35l-12.08-24.64H304c-8.836 0-16 7.161-16 15.1v175.1L64 352V80.01c0-8.834-7.164-15.1-16-15.1h-32c-8.836 0-16 7.163-16 15.1V496C0 504.8 7.164 512 16 512h32C56.84 512 64 504.8 64 496v-47.1h512V496c0 8.836 7.164 16 16 16h32c8.836 0 16-7.164 16-16V256C640 202.1 597 160 544 160zM624 48.01h-115.2l-24.88-37.31c-2.324-3.48-5.539-6.131-9.158-7.977c-1.172-.6016-2.486-.5508-3.738-.9512C468.8 1.035 466.5 0 464.1 0c-.625 0-1.25 .0254-1.875 .0781c-8.625 .6406-16.25 5.876-19.94 13.7l-42.72 90.81l-21.12-43.12c-4.027-8.223-12.39-13.44-21.54-13.44L208 48.02C199.2 48.01 192 55.18 192 64.02v15.99c0 8.836 7.163 15.1 15.1 16l133.1 .0091l36.46 74.55C382.5 178.8 390.8 184 400 184c9.219-.0781 17.78-5.438 21.72-13.78l45.91-97.52l8.406 12.62C480.5 91.1 487.1 96.01 496 96.01h128c8.836 0 16-7.164 16-16V64.01C640 55.18 632.8 48.01 624 48.01z"/></svg><br>
                    <strong class="infoText">
                        Stanze totali: <br> {{ $apartment->rooms }}
                    </strong>
                </div>
            </li>
            <li class="list-unstyled mr-3">
                <div class="infoContainer d-flex flex-column ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 512 512">
                    <path d="M495.9 132.2C505.8 137.9 512 148.5 512 160V480C512 497.7 497.7 512 480 512C462.3 512 448 497.7 448 480V178.6L256 68.86L64 178.6V480C64 497.7 49.67 512 32 512C14.33 512 0 497.7 0 480V160C0 148.5 6.153 137.9 16.12 132.2L240.1 4.216C249.1-1.405 262-1.405 271.9 4.216L495.9 132.2zM216 168C216 145.9 233.9 128 256 128C278.1 128 296 145.9 296 168C296 190.1 278.1 208 256 208C233.9 208 216 190.1 216 168zM224 512C210.7 512 200 501.3 200 488V313.5L173.1 363.4C166.8 375 152.3 379.4 140.6 373.1C128.1 366.8 124.6 352.3 130.9 340.6L168.7 270.3C184.1 241.8 213.9 223.1 246.2 223.1H265.8C298.1 223.1 327.9 241.8 343.3 270.3L381.1 340.6C387.4 352.3 383 366.8 371.4 373.1C359.7 379.4 345.2 375 338.9 363.4L312 313.5V488C312 501.3 301.3 512 288 512C274.7 512 264 501.3 264 488V400H248V488C248 501.3 237.3 512 224 512V512z"/></svg><br>
                    <strong class="infoText">
                        Camere da letto: <br> {{ $apartment->beds }}
                    </strong>
                </div>
            </li>
            <li class="list-unstyled mr-3">
                <div class="infoContainer d-flex flex-column ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 448 512">
                    <path d="M432 48C440.8 48 448 40.75 448 32V16C448 7.25 440.8 0 432 0h-416C7.25 0 0 7.25 0 16V32c0 8.75 7.25 16 16 16H32v158.7C11.82 221.2 0 237.1 0 256c0 60.98 33.28 115.2 84.1 150.4l-19.59 64.36C59.16 491.3 74.53 512 96.03 512h255.9c21.5 0 36.88-20.75 30.62-41.25L363 406.4C414.7 371.2 448 316.1 448 256c0-18.04-11.82-34.85-32-49.26V48H432zM96 72C96 67.63 99.63 64 104 64h48C156.4 64 160 67.63 160 72v16C160 92.38 156.4 96 152 96h-48C99.63 96 96 92.38 96 88V72zM224 288C135.6 288 64 273.7 64 256c0-17.67 71.63-32 160-32s160 14.33 160 32C384 273.7 312.4 288 224 288z"/></svg><br>
                    <strong class="infoText">
                        Bagni: <br>{{ $apartment->bathrooms }}
                    </strong>
                </div>
            </li>
            <li class="list-unstyled mr-3">
                <div class="infoContainer d-flex flex-column ">
                    <svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" fill="currentColor" viewBox="0 0 448 512">
                    <path d="M416 32C433.7 32 448 46.33 448 64V128C448 145.7 433.7 160 416 160V352C433.7 352 448 366.3 448 384V448C448 465.7 433.7 480 416 480H352C334.3 480 320 465.7 320 448H128C128 465.7 113.7 480 96 480H32C14.33 480 0 465.7 0 448V384C0 366.3 14.33 352 32 352V160C14.33 160 0 145.7 0 128V64C0 46.33 14.33 32 32 32H96C113.7 32 128 46.33 128 64H320C320 46.33 334.3 32 352 32H416zM368 80V112H400V80H368zM96 160V352C113.7 352 128 366.3 128 384H320C320 366.3 334.3 352 352 352V160C334.3 160 320 145.7 320 128H128C128 145.7 113.7 160 96 160zM48 400V432H80V400H48zM400 432V400H368V432H400zM80 112V80H48V112H80z"/></svg><br>
                    <strong class="infoText">
                        Metri quadrati: <br> {{ $apartment->square_meters }}
                    </strong>
                </div> 
            </li>
        </div>
        <li>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 384 512">
            <path d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z"/></svg>
            {{ $apartment->address }}
        </li>
        
        @foreach ($apartment->images as $image)
            <div class="imageContainer">
                <img class="w-75 ap-image" src="{{asset( 'storage/'.$image->url )}}" alt="">
            </div>
        @endforeach
        
    
        <h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 512 512">
            <path d="M280 145.3V112h16C309.3 112 320 101.3 320 88S309.3 64 296 64H215.1C202.7 64 192 74.75 192 87.1S202.7 112 215.1 112H232v33.32C119.6 157.3 32 252.4 32 368h448C480 252.4 392.4 157.3 280 145.3zM488 400h-464C10.75 400 0 410.7 0 423.1C0 437.3 10.75 448 23.1 448h464c13.25 0 24-10.75 24-23.1C512 410.7 501.3 400 488 400z"/></svg>
            Servizi
        </h3>
        <ul class="borderline">
            @foreach ($apartment->services as $service)
                <li>{{ $service->name }}</li>
            @endforeach
        </ul>
    
        <h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
            <path d="M511.1 63.1v287.1c0 35.25-28.75 63.1-64 63.1h-144l-124.9 93.68c-7.875 5.75-19.12 .0497-19.12-9.7v-83.98h-96c-35.25 0-64-28.75-64-63.1V63.1c0-35.25 28.75-63.1 64-63.1h384C483.2 0 511.1 28.75 511.1 63.1z"/></svg>
            Messaggi
        </h3>
        @forelse ($apartment->messages as $message)
            <p><strong>{{ $message->object }}</strong></p>
            <p>Da {{$message->name}} {{$message->lastname}} il {{$message->date}} < email: {{$message->email}} > </p>
            <p>{{ $message->content }}</p>
        @empty
            Non si sono messaggi!
        @endforelse
    
        <h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 576 512">
            <path d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"/></svg>
            Visualizzazioni
        </h3>
        @forelse ($apartment->views as $view)
            <p>{{$view->ip}} il {{$view->date}}</p>
        @empty
            <p>Non ci sono visualizzazioni!</p>
        @endforelse
    
        <div class="d-flex">
            <a href="{{route('admin.apartments.index')}}">
                <button type="button" class="btn btn-primary backBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                    <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                    Torna indietro
                </button>
            </a>
            <form  action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                @csrf
                @method("DELETE")
                <button onclick="return confirm('Sicuro di voler cancellare questo post?');" type="submit" class="btn cancelBtn ml-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 320 512">
                    <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                    Cancella
                </button>
            </form>
        </div>
    </ul>

</div>
@endsection