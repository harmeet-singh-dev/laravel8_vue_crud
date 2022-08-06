<template>
    <div>
        <h3>Manage Your Subscription</h3>
<label>Card Holder Name</label>
        <input id="card-holder-name" type="text" v-model="name" class="form-control mb-2">

        <label>Card</label>
        <div id="card-element">

        </div>
        <button class="btn btn-primary mt-3" id="add-card-button" v-on:click="submitPaymentMethod()">
            Save Payment Method
        </button>
        <div class="mt-3 mb-3">
    OR
</div>

<div v-show="paymentMethodsLoadStatus == 2
    && paymentMethods.length == 0"
    class="">
        No payment method on file, please add a payment method.
</div>

<div v-show="paymentMethodsLoadStatus == 2
        && paymentMethods.length > 0">
    <div v-for="(method, key) in paymentMethods"
            v-bind:key="'method-'+key"
            v-on:click="paymentMethodSelected = method.id"
            class="border rounded row p-1"
            v-bind:class="{
            'bg-success text-light': paymentMethodSelected == method.id
        }">
            <div class="col-2">
                {{ method.brand.charAt(0).toUpperCase() }}{{ method.brand.slice(1) }}
            </div>
            <div class="col-7">
                Ending In: {{ method.last_four }} Exp: {{ method.exp_month }} / {{ method.exp_year }}
            </div>
            <div class="col-3">
                <span v-on:click.stop="removePaymentMethod( method.id )">Remove</span>
            </div>
    </div>
</div>
<div class="mt-3 row rounded border"
        v-bind:class="{'bg-success text-light': selectedPlan == 'plan_XXX'}"
        v-on:click="selectedPlan = 'plan_XXX'">
    <div class="col-6">
        Basic
    </div>
    <div class="col-6">
        $10/mo.
    </div>
</div>

<div class="mt-3 row rounded border"
        v-bind:class="{'bg-success text-light': selectedPlan == 'plan_YYY'}"
        v-on:click="selectedPlan = 'plan_YYY'">
    <div class="col-6">
        Professional
    </div>
    <div class="col-6">
        $15/mo.
    </div>
</div>

<div class="mt-3 row rounded border"
        v-bind:class="{'bg-success text-light': selectedPlan == 'plan_ZZZ'}"
        v-on:click="selectedPlan = 'plan_ZZZ'">
    <div class="col-6">
        Enterprise
    </div>
    <div class="col-6">
        $20/mo.
    </div>
</div>
    </div>
</template>
<script>
 export default {
        data(){
            return {
                stripeAPIToken: 'pk_test_51KU33SSEDLttm8Rfw5iNzIgyj9Hk9MwezqHuu0ObbjxD3gD8KjZ1gNrg3tzS5MtTkKlNtaA2nuQR3OxD9gFqzRLi00118e38pl',
 selectedPlan: '',
                stripe: '',
                elements: '',
                card: '',
                intentToken: '',
                name: '',
                addPaymentStatus: 0,
                addPaymentStatusError: '',
                paymentMethods: [],
                paymentMethodsLoadStatus: 0,
        paymentMethodSelected: {}
            }
        },

        mounted(){
            this.loadPaymentMethods();
             this.loadIntent();
            this.includeStripe('js.stripe.com/v3/', function(){
                this.configureStripe();
            }.bind(this) );
        },


        methods: {
            /*
                Includes Stripe.js dynamically
            */
           updateSubscription(){
    axios.put('/api/v1/user/subscription', {
        plan: this.selectedPlan,
        payment: this.paymentMethodSelected
    }).then( function( response ){
        alert('You Are Subscribed!');
    }.bind(this));
},

           loadPaymentMethods(){
    this.paymentMethodsLoadStatus = 1;

    axios.get('/api/v1/user/payment-methods')
        .then( function( response ){
            this.paymentMethods = response.data;

            this.paymentMethodsLoadStatus = 2;
        }.bind(this));
},
           removePaymentMethod( paymentID ){
    axios.post('/api/v1/user/remove-payment', {
        id: paymentID
    }).then( function( response ){
        this.loadPaymentMethods();
    }.bind(this));
},
           loadPaymentMethods(){
    axios.get('/api/v1/user/payment-methods')
        .then( function( response ){
            this.paymentMethods = response.data;
        }.bind(this));
},

           savePaymentMethod( method ){
    axios.post('/api/v1/user/payments', {
        payment_method: method
    }).then( function(){
        this.loadPaymentMethods();
    }.bind(this));
},
           submitPaymentMethod(){
    this.addPaymentStatus = 1;

    this.stripe.confirmCardSetup(
        this.intentToken.client_secret, {
            payment_method: {
                card: this.card,
                billing_details: {
                    name: this.name
                }
            }
        }
    ).then(function(result) {
        if (result.error) {
            this.addPaymentStatus = 3;
            this.addPaymentStatusError = result.error.message;
        } else {
            this.savePaymentMethod( result.setupIntent.payment_method );
            this.addPaymentStatus = 2;
            this.card.clear();
            this.name = '';
        }
    }.bind(this));
},
           loadIntent(){
         axios.get('/api/v1/user/setup-intent')
        .then( function( response ){
            this.intentToken = response.data;
        }.bind(this));
},
            includeStripe( URL, callback ){
                let documentTag = document, tag = 'script',
                    object = documentTag.createElement(tag),
                    scriptTag = documentTag.getElementsByTagName(tag)[0];
                object.src = '//' + URL;
                if (callback) { object.addEventListener('load', function (e) { callback(null, e); }, false); }
                scriptTag.parentNode.insertBefore(object, scriptTag);
            },

            /*
                Configures Stripe by setting up the elements and
                creating the card element.
            */
            configureStripe(){
                this.stripe = Stripe( this.stripeAPIToken );

                this.elements = this.stripe.elements();
                this.card = this.elements.create('card');

                this.card.mount('#card-element');
            },
        }
    }
</script>
