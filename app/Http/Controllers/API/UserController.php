<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Creates an intent for payment so we can capture the payment
     * method for the user.
     *
     * @param Request $request The request data from the user.
     */
    public function getSetupIntent( Request $request ){
        return $request->user()->createSetupIntent();
    }

    public function postPaymentMethods( Request $request ){
    $user = $request->user();
    $paymentMethodID = $request->get('payment_method');

    if( $user->stripe_id == null ){
        $user->createAsStripeCustomer();
    }

    $user->addPaymentMethod( $paymentMethodID );
    $user->updateDefaultPaymentMethod( $paymentMethodID );

    return response()->json( null, 204 );
}

public function getPaymentMethods( Request $request ){
    $user = $request->user();

    $methods = array();

    if( $user->hasPaymentMethod() ){
        foreach( $user->paymentMethods() as $method ){
            array_push( $methods, [
                'id' => $method->id,
                'brand' => $method->card->brand,
                'last_four' => $method->card->last4,
                'exp_month' => $method->card->exp_month,
                'exp_year' => $method->card->exp_year,
            ] );
        }
    }

    return response()->json( $methods );
}

public function removePaymentMethod( Request $request ){
    $user = $request->user();
    $paymentMethodID = $request->get('id');

    $paymentMethods = $user->paymentMethods();

    foreach( $paymentMethods as $method ){
        if( $method->id == $paymentMethodID ){
            $method->delete();
            break;
        }
    }

    return response()->json( null, 204 );
}

public function updateSubscription( Request $request ){
    $user = $request->user();
    $planID = $request->get('plan');
    $paymentID = $request->get('payment');

    if( $user->subscribed('Super Notes') ){
        $user->newSubscription( 'Super Notes', $planID )
                ->create( $paymentID );
    }else{
        $user->subscription('Super Notes')->swap( $planID );
    }

    return response()->json([
        'subscription_updated' => true
    ]);
}
}
