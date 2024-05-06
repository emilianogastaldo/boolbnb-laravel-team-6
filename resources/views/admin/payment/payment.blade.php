@extends('layouts.app')
@section('title', 'Pagamento')

@section('cdns')
    <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
@endsection

@section('content')
    <div id="payment_container" class="container">
        {{-- <div class="col-12">
            {{-- <div id="isSent" class="text-bg-success message success d-none align-items-center justify-content-center">
                <i class="fa-solid fa-circle-check fa-fade"></i>
                <span class="ms-2 me-4">Pagamento effettuato con successo! <br> Sarai renderizzato tra 5 secondi...</span>
            </div> --}}
            <div id="isSentNone" class="text-bg-danger message danger d-none align-items-center justify-content-center">
                <i class="fa-solid fa-circle-check fa-fade"></i>
                <span class="ms-2 me-4">Pagamento fallito!</span>
            </div>
        </div>
        
        <div class="col-12">
            <h1 class="back-gold mb-4">
                <span class="icon-section me-2">
                    <i class="fa-solid fa-crown fa-sm"></i>
                </span>
                Pagamento
            </h1>   
            
        </div>
        <div class="row d-flex align-items-center justify-content-center" id="payment-row">
            <div class="col-4 d-none" id="isSent" class="col-12 d-flex align-items-center justify-content-center flex-column gap-2 d-none">
                <div class="card" style="width: 400px;">
                    <div class="card-body">
                        @if($sponsorship_id == 1)
                            <h4 class="card-title">Grazie per aver acquistato il pacchetto sponsorizzazione <span class="text-argento"> Argento</span>.</h5>
                        @elseif ($sponsorship_id == 2)
                            <h4 class="card-title">Grazie per aver acquistato il pacchetto sponsorizzazione <span class="text-oro"> Oro</span>.</h5>
                        @elseif ($sponsorship_id == 3)
                            <h4 class="card-title">Grazie per aver acquistato il pacchetto sponsorizzazione <span class="text-platino"> Platino</span>.</h5>
                        @endif
                        <p class="card-text">Il tuo appartamento sarà visibile in home page in una sezione dedicata fino al <span id="expiration"></span>.</p>
                        <div class="text-center">
                            <a class="btn btn-primary mb-2" href="{{ route('admin.flats.index') }}">
                                Torna alla home
                                <i class="fa-solid fa-house"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-4">
                <div class="d-flex align-items-center justify-content-center flex-column">
                    @csrf
                    {{-- Stile fornito da Braintree --}}
                    <div id="dropin-container" style="width: 300px"></div>
                    
                    <div class="info-payment text-center">
                        <a id="submit-button" class="btn btn-sm btn-success">
                            Procedi al pagamento
                        </a>
                    </div>
                </div>
            </div>   
        </div>
        <div class="d-flex justify-content-start" id="goBack">
            <a class="btn btn-secondary mb-2" href="{{ route('admin.sponsorships.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Torna alle sponsorizzazioni
            </a>
        </div>
    </div>
@endsection



@section('scripts')
    <script>
        
        const button = document.querySelector('#submit-button');
        const expirationField = document.getElementById('expiration');

        const urlParams = new URLSearchParams(window.location.search);
        let sponsorship = urlParams.get('sponsorship_id');
        let flat = urlParams.get('flat_id');

        // Creo la tendina
        braintree.dropin.create({
            authorization: '{{ $token }}',
            container: '#dropin-container'
        }, function(createErr, dropinInstance) {
            if (createErr) {
                console.error(createErr);
                return;
            }
            const instance = dropinInstance;

            // Creo la richiesta per la rotta process
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    $.get('{{ route('admin.payment.process') }}', {
                        payload,
                        sponsorship,
                        flat

                    }, function(response) {
                        if (response.success) {
                            // Messaggio di successo
                            $('#submit-button').addClass('d-none');
                            $('#isSent').removeClass('d-none');
                            $('#goBack').addClass('d-none');
                            expirationField.innerText = response.expiration_date;
                        } else {
                            // Messaggio di pagamento fallito
                            $('#isSentNone').removeClass('d-none').addClass('d-flex');

                            setTimeout(function() {
                                $('#isSentNone').removeClass('d-flex').addClass(
                                    'd-none');
                            }, 5000);
                            

                            alert('Pagamento fallito. Riprova');
                        }
                    }, 'json');
                });
            });
        });
    </script>
@endsection