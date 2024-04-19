<span>I campi con <span class="text-danger">*</span> sono obbligatori </span>
@if ($flat->exists)
    <form action="{{route('admin.flats.update', $flat)}}" enctype="multipart/form-data" method="POST">
        @method('PUT')
    @else
    <form action="{{route('admin.flats.store')}}" enctype="multipart/form-data" method="POST"> 
@endif
    @csrf
    <div class="row my-3 g-4">
        {{-- Input per il titolo della casa --}}
        <div class="col-6">
            <div class="form-floating">
                <input type="text" class="form-control @error('title') is-invalid @elseif(old('title', '')) is-valid @enderror" name="title" id="title" value="{{old('title', $flat->title)}}" placeholder="">    
                <label for="title" class="form-label">Dai un nome all'appartamento<span class="text-danger"> * </span></label>
                @error('title')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>


        {{-- Input per la via della casa --}}
        <div class="col-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="address" name="address" value="{{old('address', $flat->address)}}" placeholder="">
                <label for="address" class="form-label">Scrivi la via dell'appartamento<span class="text-danger"> * </span></label>
            </div>
        </div>

        {{-- Input di stanze, letti, bagni, metratura, --}}
        <div class="col-3">
            {{-- stanze --}}
            <div class="form-floating">
                <input type="number" min="1" max="255" class="form-control @error('room') is-invalid @elseif(old('room', '')) is-valid @enderror" id="room" name="room" value="{{old('room', $flat->room)}}" placeholder="">
                <label for="room" class="form-label">Inserisci numero stanze<span class="text-danger"> * </span></label>
                @error('room')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-3">
            {{-- letti --}}
            <div class="form-floating">
                <input type="number" min="1" max="255" class="form-control @error('bed') is-invalid @elseif(old('bed', '')) is-valid @enderror" id="bed" name="bed" value="{{old('bed', $flat->bed)}}" placeholder="">
                <label for="bed" class="form-label">Inserisci posti letto<span class="text-danger"> * </span></label>
                @error('bed')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-3">
            {{-- bagni --}}
            <div class="form-floating">
                <input type="number" min="1" max="255" class="form-control @error('bathroom') is-invalid @elseif(old('bathroom', '')) is-valid @enderror" id="bathroom" name="bathroom" value="{{old('bathroom', $flat->bathroom)}}" placeholder="">
                <label for="bathroom" class="form-label">Inserisci numero bagni<span class="text-danger"> * </span></label>
                @error('bathroom')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-3">
            {{-- metratura --}}
            <div class="form-floating">
                <input type="number" min="0" max="65535" class="form-control @error('sq_m') is-invalid @elseif(old('sq_m', '')) is-valid @enderror" id="sq_m" name="sq_m" value="{{old('sq_m', $flat->sq_m)}}" placeholder="Inserisci metratura">
                <label for="sq-m">Metratura in m<sup>2</sup> <span class="text-danger"> * </span></label>
                @error('sq_m')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
        
        {{-- Input aggiunta immagine --}}
        <div class="col-12">
            <div class="form-floating">
                <input type="text" class="form-control" id="image" name="image" value="{{old('image', $flat->image)}}" placeholder="">    
                <label for="image">Aggiungi url immagine<span class="text-danger"> * </span></label>
            </div>
        </div>

        {{-- Input descrizione dell'appartamento --}}
        <div class="col-12">
            <div class="form-floating">
                <textarea class="form-control" placeholder="" id="description" name="description" style="height: 150px">{{old('description', $flat->description)}}</textarea>
                <label for="description">Scrivi una descrizione dell'appartamento <span class="text-danger"> * </span></label>
            </div>        
        </div>

        {{-- Input bozza o pubblico --}}
        <div class="col">
            <div class="form-check form-switch form-check-reverse">
                <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible">
                <label class="form-check-label" for="is_visible">Pubblicato</label>
            </div>
        </div>
    </div>
    <button class="btn btn-success">Salva</button>
    <a class="btn btn-primary" href="{{route('admin.flats.index')}}">Torna indietro</a>
</form>

