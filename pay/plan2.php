<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="../images/code.png" type="image/x-icon"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Premium Plan | Codevizag Academy</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/fonts/roboto/Roboto-Regular.woff">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
</head>
<body>
	<div id="app" v-cloak>
  <div class="header">
  <nav style="background-image: linear-gradient(to right,#43cea2, #185a9d)  !important;">
    <div class="nav-wrapper container">
      <a href="#" class="brand-logo"><i class="material-icons">shopping_cart</i><img src="../images/logo.png"></a>
    </div>
  </nav>
      <div class="progress-container hide-on-med-and-up">
      <div class="progress-bar js-progress-bar"></div>
    </div>   
  </div>
  <div class="container wrapper">
    <div class="row hide-on-med-and-up" v-cloak>
      <div class="col s12 m6">
        <div class="card">
          <div class="card-content">
            <p><b>Items in cart:</b> {{cartSummary.length}}</p>
            <p><b>Shipping:</b> {{chosenShippingMethod.name}} - ₹{{shippingPrice}}</p>
            <p><b>Total:</b> ₹{{basketTotal}}</p>
            <span class="small-text grey-text text-darken-2 m-top-10 ">Fill out the information below and go directly to payment by clicking the button.</span>
          </div>
          <a v-on:click="scrollToBottom(); $v.name.$touch(); $v.address.$touch(); $v.email.$touch(); $v.phone.$touch();" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">arrow_downward
</i></a>
        </div>

      </div>
    </div><br><br><br>
    <div class="row">
      <div class="col s12 m6">
        <div class="card" id="step-1">
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4"><b>Details</b></span>
            <div class="row m-top-15">
              <form class="col s12">
                <div class="row">
                  <div class="input-field col s12 l6 m-top-15">
                    <input id="first_name" @blur="$v.name.$touch()" :class="{'invalid': $v.name.$error}" v-model="name" type="text" autocomplete="name">
                    <label for="first_name">Full name</label>
                    <span v-if="$v.name.$error" class="helper-text" data-error="Please fill out full name">Helper text</span>

                  </div>
                  <div class="input-field col s12 l6 m-top-15">
                    <input id="company" v-on:blur="setCompanyShipping" v-model="company" type="text" class="validate">
                    <label for="company">Company (optional)</label>
                  </div>
                </div>
                <div class="row m-top-15">
                  <div class="input-field col s12 autocomplete-container">
                    <input class="js-autocomplete-input" id="dawa-autocomplete-input" @blur="$v.address.$touch()" :class="{'invalid': $v.address.$error}" v-model="addressInput" type="url" class="validate" autocomplete="false">
                    <label for="dawa-autocomplete-input">Full address</label>
                    <span v-if="$v.address.$error" class="helper-text" data-error="Please fill out full address">Helper text</span>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 l6 m-top-15">
                    <input @blur="$v.email.$touch()" :class="{'invalid': $v.email.$error}" id="email" v-model="email" type="text" class="validate" autocomplete="email">
                    <label for="email">Email</label>
                    <span v-if="$v.email.$error" class="helper-text" data-error="Please fill out email">Helper text</span>
                  </div>
                  <div class="input-field col s12 l6 m-top-15">
                    <input @blur="$v.phone.$touch()" :class="{'invalid': $v.phone.$error}" id="phone" v-model="phone" type="text" class="validate" autocomplete="tel">
                    <label for="phone">Phone
                    </label>
                    <span v-if="$v.phone.$error" class="helper-text" data-error="Please fill out phone">Helper text</span>
                  </div>
                </div>
                <label class="d-block m-top-15">
                  <input type="checkbox" v-model="showAlternative" class="filled-in" />
                  <span>Choose alternative delivery</span>
                </label>

                <div v-if="showAlternative" class="m-top-15">
                  <div class="row m-top-15" v-if="showAlternative">
                    <div class="input-field col s12 l6">
                      <input id="del_first_name" v-model="delName" type="text" class="validate">
                      <label for="del_first_name">Full name</label>
                    </div>
                    <div class="input-field col s12 l6">
                      <input id="del_company" v-model="delCompany" type="text" class="validate">
                      <label for="del_company">Company (optional)</label>
                    </div>
                  </div>
                  <div class="row m-top-15">
                    <div class="input-field col s12 autocomplete-container">
                      <input class="autocomplete" id="del_address" class="validate" v-model="delAddressInput" type="text" class="validate" autocomplete="shipping street-address">
                      <label for="del_address">Full address</label>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card" id="step-2" v-cloak>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4"><b>Shipping</b></span>
            <p>Pleasse choose your desired shipping provider.</p>
            <form action="#">
              <p class="p-top-10" v-for="(shippingMethod, index) in shippingMethods">
                <label>
                  <input v-model="shipping" name="group1" :value="shippingMethod.id" type="radio" :id="shippingMethod.id" class="with-gap m-top-15" />
                  <span>{{shippingMethod.desc}} - ₹{{shippingMethod.price}}</span>
                </label>
              </p>
            </form>
            <span class="card-title activator grey-text text-darken-4 m-top-15 p-top-10"><b>Voucher</b></span>
            <label v-if="!showVoucher" class="d-block m-top-15">
                  <input type="checkbox" v-model="showVoucher" class="filled-in" />
                  <span>I Have A Voucher Code</span>
                </label>
            <div v-if="showVoucher" class="row m-top-10 p-top-10">
              <div class="input-field col s12 l6">
                <input id="voucher" type="text" class="validate">
                <label for="voucher">Voucher Code</label>
              </div>
              <div class="col s12 l6">
                <a class="waves-effect waves-light btn indigo darken-4 m-top-10" onclick="myFunction()">Add voucher</a>



      
              </div>
            </div>
          </div>
        </div>
        <div class="card" id="step-3" v-cloak>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4"><b>Maybe you could also be interested in...</b></span>
            <div class="row m-top-15">
              <swiper ref="awesomeSwiper" :options="swiperOptions">
                <!-- slides -->
<swiper-slide>
                  <div class="card">
                    <div class="card-image">
                      <img src="img/free.png">
                      <a class="btn-floating halfway-fab waves-effect waves-light indigo darken-4"><i class="material-icons">shopping_basket</i></a>
                    </div>
                    <div class="card-content">
                      <span class="flow-text">Free <br>Plan</span>
                      <div class="row">
                        <div class="d-block input-field col m5">
                          <select><option value="" disabled>Quantity</option>
                          <option value="1" >1</option>
                        </select>
                        </div>
                        <div class="d-block input-field col m7">
                          <span class="related__product-price">₹0</span>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </swiper-slide>
<swiper-slide>
                  <div class="card">
                    <div class="card-image">
                      <img src="img/business.png">
                      <a class="btn-floating halfway-fab waves-effect waves-light indigo darken-4"><i class="material-icons">shopping_basket</i></a>
                    </div>
                    <div class="card-content">
                      <span class="flow-text">Business <br>Plan</span>
                      <div class="row">
                        <div class="d-block input-field col m5">
                           <select><option value="" disabled>Quantity</option>
                          <option value="1" >1</option>
                        </select>
                        </div>
                        <div class="d-block input-field col m7">
                          <span class="related__product-price">₹999</span>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </swiper-slide>
                
                <swiper-slide>
                  <div class="card">
                    <div class="card-image">
                      <img src="img/premium.png">
                      <a class="btn-floating halfway-fab waves-effect waves-light indigo darken-4"><i class="material-icons">shopping_basket</i></a>
                    </div>
                    <div class="card-content">
                      <span class="flow-text">Premium <br>Plan</span>
                      <div class="row">
                        <div class="d-block input-field col m5">
                          <select><option value="Selected" disabled>Selected</option>
                          
                        </select>
                         
                        </div>
                        <div class="d-block input-field col m7">
                          <span class="related__product-price">₹1999</span>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </swiper-slide>
                <div class="swiper-pagination" slot="pagination"></div>
                <div class="swiper-button-prev" slot="button-prev"></div>
                <div class="swiper-button-next" slot="button-next"></div>
              </swiper>

            </div>
          </div>
        </div>
      </div>
      <div class="col s12 m6">
        <div class="card" id="step-4" v-cloak>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4"><b>Order summary</b></span>
            <div class="row info">
              <div class="col s12 m6">
                <p><b>Billing address:</b></p>
                <p>{{ name }}</p>
                <p>{{ company }}</p>
                <p>{{ addressComputed }}</p>
                <p>{{ cityComputed }}</p>
                <p>{{ email }}</p>
                <p>{{ phone }}</p>
              </div>
              <div class="col s12 m6" v-if="showAlternative">
                <p><b>Delivery address:</b></p>
                <p>{{ delName }}</p>
                <p>{{ delCompany }}</p>
                <p>{{ delAddressComputed }}</p>
                <p>{{ delCityComputed }}</p>
              </div>
            </div>
            <span class="card-title activator grey-text text-darken-4 m-top-15"><b>Your order</b></span>
            <span><b>{{ products.length }} items</b></span>
            <ul class="collection">
              <li class="collection-item avatar" ref="item-1" v-for="(product, index) in products">
                <img :src="product.image" alt="Business Plan" class="circle">
                <div class="row">
                  <div class="col s12 l4">
                    <span class="title">{{ product.name }}</span>
                    <p>₹{{ product.price }}</p>
                  </div>
                  
                  <div class="input-field col s6 l2">
                    <quantity-select :product-id="product.id"></quantity-select>
                  </div>
                </div>
                <a href="#!" class="secondary-content"><i class="material-icons" v-on:click="deleteItem(product.id)">clear</i></a>
              </li>
            </ul>
            <ul>
              <li v-if="shipping">
                <span><b>Shipping</b> <i>{{chosenShippingMethod.desc}}</i></span>
                <span class="right">₹{{chosenShippingMethod.price}}</span>
              </li>
              <li v-if="taxTotal">
                <span><b>PAYMENT GATEWAY TAX(2%)</b></span>
                <span class="right">₹{{taxTotal}}</span>
              </li>
            </ul>
          </div>
          <div class="card-action" v-if="basketTotal">
            <span><b>Total</b></span>
            <span class="right"><b>₹{{basketTotal}}</b></span>
          </div>
          <div class="card-action">
            <span class="card-title activator grey-text text-darken-4"><b>Payment</b></span>
            <p class="payment-info">Please Choose Your Desired Payment Method. Debit/Credit Card Option Will Redirect You To The Payment Gateway.</p>
            <p>
              <label>
                  <input type="checkbox"  class="filled-in" />
                  <span class="activator grey-text text-darken-4">Sign Me Up For The Free Newsletter.</span>
              </label></p>
            <p>
              <label>
                  <input type="checkbox" v-model="consent" class="filled-in" checked>
                  <span class="activator grey-text text-darken-4">I Hereby Confirm That The Information That I Have Provided Is Correct & That I Accept The <a href="#" class="indigo-text text-darken-4">Terms & Conditions</a>.</span>
              </label></p>
            
            
              
            <a ref="link" v-on:click="goToPayment($event); $v.$touch();" href="https://www.payumoney.com/paybypayumoney/#/AB99A66FAA7BFADCD64F0E5CB7EACA9C" class="waves-effect waves-light btn-credit-card blue"><i class="material-icons left">credit_card</i>Pay With PayUMoney</a>

             
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vuex/3.0.1/vuex.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>
<script type="text/javascript" src="https://dawa.aws.dk/js/autocomplete/dawa-autocomplete2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue-awesome-swiper@3.1.2/dist/vue-awesome-swiper.js"></script>
<script type="text/javascript" src="https://unpkg.com/vuelidate@0.6.2/dist/vuelidate.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/vuelidate@0.6.2/dist/validators.min.js"></script>
<script type="text/javascript" src="js/Plan2.js"></script>
</body>
</html>