<span>I campi con <span class="text-danger">*</span> sono obbligatori </span>
@if ($flat->exists)
    <form action="{{route('admin.flats.update', $flat)}}" enctype="multipart/form-data" method="POST">
        @method('PUT')
    @else
    <form action="{{route('admin.flats.store')}}" enctype="multipart/form-data" method="POST"> 
@endif
    @csrf
    {{-- @dd($flat) --}}
    <div class="row my-3 g-4">
        <div class="col-6">
            <div class="row g-4">
                {{-- Input per il titolo della casa --}}
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('title') is-invalid @elseif(old('title', '')) is-valid @enderror" name="title" id="title" value="{{old('title', $flat->title)}}" placeholder="">    
                        <label for="title" class="form-label">Dai un nome all'appartamento<span class="text-danger"> * </span></label>
                        @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">                    
                    {{-- Input per la via della casa --}}
                    <div class="form-floating mb-3 d-none">
                        <input type="text" class="form-control @error('address') is-invalid @elseif(old('address', '')) is-valid @enderror" id="address" name="address" value="{{old('address', $flat->address)}}" placeholder="">
                        <label for="address" class="form-label">Scrivi la via dell'appartamento<span class="text-danger"> * </span></label>
                    </div>
                    {{-- SearchBox --}}
                    <div id="ricerca" class="form-floating mb-3"></div>
                </div>

                {{-- Input di stanze, letti, bagni, metratura, --}}
                <div class="col-6 ">
                    {{-- stanze --}}
                    <div class="form-floating mb-4">
                        <input type="number" min="1" max="255" class="form-control @error('room') is-invalid @elseif(old('room', '')) is-valid @enderror" id="room" name="room" value="{{old('room', $flat->room)}}" placeholder="">
                        <label for="room" class="form-label">Inserisci numero stanze<span class="text-danger"> * </span></label>
                        @error('room')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    {{-- bagni --}}
                    <div class="form-floating">
                        <input type="number" min="1" max="255" class="form-control @error('bathroom') is-invalid @elseif(old('bathroom', '')) is-valid @enderror" id="bathroom" name="bathroom" value="{{old('bathroom', $flat->bathroom)}}" placeholder="">
                        <label for="bathroom" class="form-label">Inserisci numero bagni<span class="text-danger"> * </span></label>
                        @error('bathroom')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    {{-- letti --}}
                    <div class="form-floating mb-4">
                        <input type="number" min="1" max="255" class="form-control @error('bed') is-invalid @elseif(old('bed', '')) is-valid @enderror" id="bed" name="bed" value="{{old('bed', $flat->bed)}}" placeholder="">
                        <label for="bed" class="form-label">Inserisci posti letto<span class="text-danger"> * </span></label>
                        @error('bed')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    {{-- metratura --}}
                    <div class="form-floating">
                        <input type="number" min="0" max="65535" class="form-control @error('sq_m') is-invalid @elseif(old('sq_m', '')) is-valid @enderror" id="sq_m" name="sq_m" value="{{old('sq_m', $flat->sq_m)}}" placeholder="Inserisci metratura">
                        <label for="sq_m">Metratura in m<sup>2</sup> <span class="text-danger"> * </span></label>
                        @error('sq_m')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Input immagine --}}
        <div class="col-6">
            <div class="form-group">
                <input id="image" class="form-control mb-2 @error('image') is-invalid @elseif(old('image', '')) is-valid @enderror" type="file" name="image" value="{{old('image', $flat->image)}}">
                <label for="image">Carica un'immagine (che sia .png o .jpg) <span class="text-danger"> * </span></label>
                @error('image')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="mt-3">
                <img src="{{old('image', $flat->image) ? $flat->printImage() : 'https://marcolanci.it/boolean/assets/placeholder.png'}}" alt="{{ $flat->image ? $flat->title : 'preview'}}" class="img-fluid" id="preview">
            </div>
        </div>

        {{-- Input descrizione dell'appartamento --}}
        <div class="col-12">
            <div class="form-floating">
                <textarea class="form-control @error('sq_m') is-invalid @elseif(old('sq_m', '')) is-valid @enderror" placeholder="" id="description" name="description" style="height: 150px">{{old('description', $flat->description)}}</textarea>
                <label for="description">Scrivi una descrizione dell'appartamento <span class="text-danger"> * </span></label>
                @error('description')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>        
        </div>

        {{-- Input bozza o pubblico --}}
        <div class="col">
            <div class="form-check form-switch form-check-reverse">
                {{-- @dd($flat->is_visible) --}}
                <input class="form-check-input" type="checkbox" role="switch" name="is_visible" id="is_visible" value="" @if (old('is_visible', $flat->is_visible)) checked @endif>
                <label class="form-check-label" for="is_visible">Pubblicato</label>
            </div>
        </div>

        {{-- Checkbox per i servizi --}}
        <div class="mb-3">
            @foreach ($services as $service)
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="{{"service-$service->id"}}">{{$service->name}}</label>
                <input class="form-check-input" type="checkbox" id="{{"service-$service->id"}}" value="{{$service->id}}" name="services[]" @if(in_array($service->id, old('services', $prev_services ?? []))) checked @endif>
            </div>
            @endforeach
        </div>

    </div>
    <button class="btn btn-success">Salva</button>
    <a class="btn btn-primary" href="{{route('admin.flats.index')}}">Torna indietro</a>
</form>

<script type="module">
    // Ricerca TomTom
    const ricerca = document.getElementById('ricerca');
    const options = {
        searchOptions: {
            key: "MZLTSagj2eSVFwXRWk7KqzDDNLrEA6UF",
            language: "en-GB",
            countrySet: "IT",
            limit: 5,
        },
        autocompleteOptions: {
            key: "MZLTSagj2eSVFwXRWk7KqzDDNLrEA6UF",
            language: "en-GB",
        },    
    };
    const ttSearchBox = new tt.plugins.SearchBox(tt.services, options)
    const searchBoxHTML = ttSearchBox.getSearchBoxHTML();
    
    ricerca.appendChild(searchBoxHTML);

    // Aggiorna il valore dell'input quando viene selezionato un indirizzo nella searchbox
    ttSearchBox.on('tomtom.searchbox.resultselected', (e) => {
        const addressInput = document.getElementById('address');
        addressInput.value = e.data.result.address.freeformAddress;
    });

    //? TODO Mettere un placeholder e tenere l'old 

    //! AddEventListener non funziona con gli oggetti di eventi personalizzati come 'tomtom.searchbox.resultselected' si deve usare .on
</script>