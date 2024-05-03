<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Braintree\Transaction;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function token(Request $request)
    {
        if (request()->input('flat_id') && request()->input('sponsorship_id')) {
            $flatId = request()->input('flat_id');
            $sponsorshipId = request()->input('sponsorship_id');

            $user = Auth::user();
            $flat = $user->flats->where('id', $flatId);
            if ($flat->isEmpty() || ($sponsorshipId > 3 || $sponsorshipId <= 0)) {
                return to_route('admin.sponsorships.index')->with('type', 'danger')->with('message', 'Ci dispiace, la pagina non esiste, riprova di nuovo.');
            }
            $gateway = new \Braintree\Gateway([
                'environment' => env("BRAINTREE_ENV"),
                'merchantId' => env("BRAINTREE_MERCHANT_ID"),
                'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
                'privateKey' => env("BRAINTREE_PRIVATE_KEY")
            ]);
            $clientToken = $gateway->clientToken()->generate();
            return view('admin.payment.payment', ['token' => $clientToken]);
        } else {
            return to_route('admin.sponsorships.index')->with('type', 'danger')->with('message', 'Ci dispiace, la pagina non esiste, riprova di nuovo.');
        }
    }

    public function process(Request $request)
    {
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $sponsorshipId = request()->input('sponsorship');
        $flatId = request()->input('flat');
        $sponsorship = Sponsorship::where('id', $sponsorshipId)->first();

        $status = Transaction::sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        // $currentDate = date("Y-m-d H:i:s");
        // $currentDateMin = date("Y-m-d H:i:s", strtotime('+' . $sponsorship->duration . 'hours', strtotime($currentDate)));

        $flat = Flat::find($flatId);
        $today = Carbon::now('Europe/Rome');

        $data['expiration_date'] = $today;
        $flat->sponsorships()->attach($data['sponsorship_id']);

        return response()->json($status);
    }
}
