"use strict";

var _validations;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

Vue.use(Vuex);
Vue.use(VueAwesomeSwiper);
Vue.use(window.vuelidate.default);
var _window$validators = window.validators,
    required = _window$validators.required,
    email = _window$validators.email,
    numeric = _window$validators.numeric;
var store = new Vuex.Store({
  state: {
    products: [{
      id: "727026",
      name: "Premium Plan",
      image: "img/bg.jpg",
      price: 1999
    }, {
      id: "727027",
      name: "Premium Support",
      image: "img/bg.jpg",
      price: 1
    }],
    shippingMethods: [{
      id: "E-Mail",
      name: "E-Mail",
      desc: "E-Mail - Order Delivered To Their Mail Address",
      price: "0",
      type: "private"
    }, {
      id: "Express Delivery",
      name: "Express Delivery",
      desc: "Express Delivery - Usually Delevers In 5-7 Days",
      price: "199",
      type: "private"
    }, {
      id: "Speed Post - Usually Delevers In 2 Days",
      name: "Speed Post",
      desc: "Speed Post - Usually Delevers In 2 Days",
      price: "499",
      type: "private"
    }],
    basket: {
      basketId: "234235",
      basketTotal: 0,
      orderlines: [],
      shippingPrice: 1
    }
  },
  mutations: {
    setBasketOrderline: function setBasketOrderline(state, product) {
      product.quantity = 1;
      state.basket.orderlines.push(product);
    },
    setShippingPrice: function setShippingPrice(state, price) {
      state.basket.shippingPrice = state.basket.shippingPrice + parseInt(price);
      store.dispatch("reCalculateBasket");
    },
    setOrderlineValues: function setOrderlineValues(state, props) {
      var orderline = state.basket.orderlines.find(function (x) {
        return x.id === props.productId;
      });
      orderline.quantity = parseInt(props.quantity);
      orderline.price = orderline.price * parseInt(props.quantity);
      store.dispatch("reCalculateBasket");
    },
    reCalculateBasket: function reCalculateBasket(state) {
      var totalProductPrice = 0;
      state.basket.basketTotal = 0; // Reset basketTotal

      $.each(state.basket.orderlines, function (index, product) {
        totalProductPrice = totalProductPrice + product.price;
      });
      state.basket.basketTotal = state.basket.basketTotal + totalProductPrice + state.basket.shippingPrice;
    },
    removeProduct: function removeProduct(state, productId) {
      state.basket.orderlines = $.grep(state.basket.orderlines, function (orderline) {
        return orderline.id != productId;
      });
      state.products = $.grep(state.products, function (product) {
        return product.id != productId;
      });
      store.dispatch("reCalculateBasket");
    }
  },
  actions: {
    initializeBasket: function initializeBasket(context, products) {
      $.each(products, function (index, product) {
        context.commit("setBasketOrderline", product);
        context.commit("reCalculateBasket");
      });
    },
    calculateShipping: function calculateShipping(context, price) {
      context.commit("setShippingPrice", price);
    },
    updateOrderline: function updateOrderline(context, props) {
      context.commit("setOrderlineValues", {
        productId: props.productId,
        quantity: props.quantity
      });
    },
    reCalculateBasket: function reCalculateBasket(context) {
      context.commit("reCalculateBasket");
    },
    removeProduct: function removeProduct(context, productId) {
      context.commit("removeProduct", productId);
    }
  },
  getters: {}
}); // Locally Registered Component

var quantitySelect = {
  name: "quantitySelect",
  props: ["productId"],
  data: function data() {
    return {
      quantity: 1
    };
  },
  template: "\n    <select v-model=\"quantity\">\n      <option value=\"\" disabled>Quantity</option>\n      <option v-for=\"(n, index) in 1\" :value=\"n\">{{n}} Item</option>\n    </select>\n  ",
  computed: {
    orderlines: function orderlines() {
      return this.$store.state.basket.orderlines;
    }
  },
  watch: {
    quantity: {
      handler: function handler(quantity) {
        this.changeQuantity(quantity, this.productId);
      },
      deep: true
    }
  },
  methods: {
    changeQuantity: function changeQuantity(quantity, productId) {
      this.$store.dispatch("updateOrderline", {
        productId: productId,
        quantity: quantity
      });
    }
  }
};
new Vue({
  el: "#app",
  name: "CheckOut",
  components: {
    "quantity-select": quantitySelect
  },
  store: store,
  data: function data() {
    return {
      name: "",
      company: "",
      email: "",
      phone: "",
      address: "",
      houseNumber: "",
      floor: "",
      door: "",
      city: "",
      zip: "",
      delName: "",
      delCompany: "",
      delAddress: "",
      delHouseNumber: "",
      delFloor: "",
      delDoor: "",
      delCity: "",
      delZip: "",
      delAddressInput: "",
      addressInput: "",
      showAlternative: false,
      
      shipping: "E-Mail",
      showVoucher: "",
      consent: "",
      swiperOptions: {
        slidesPerView: 4,
        spaceBetween: 1,
        roundLengths: true,
        // fix blurry text
        watchSlidesProgress: true,
        watchSlidesVisibility: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        },
        breakpoints: {
          2166: {
            slidesPerView: 3.2
          },
          1920: {
            slidesPerView: 3
          },
          1640: {
            slidesPerView: 2.6
          },
          1440: {
            slidesPerView: 2.3
          },
          1250: {
            slidesPerView: 1.8
          },
          640: {
            slidesPerView: 1.6
          }
        },
        on: {
          init: function init() {
            // Hide pagination if only one is present
            var paginationBullets = $(".swiper-pagination");

            if (paginationBullets.length == 1) {
              paginationBullets.hide();
            }
          }
        }
      }
    };
  },
  validations: (_validations = {
    name: {
      required: required
    },
    address: {
      required: required
    }
  }, _defineProperty(_validations, "address", {
    required: required
  }), _defineProperty(_validations, "email", {
    required: required,
    email: email
  }), _defineProperty(_validations, "phone", {
    required: required,
    numeric: numeric
  }), _validations),
  created: function created() {
    this.$store.dispatch("initializeBasket", this.products);
    this.scrollIndicator();
  },
  mounted: function mounted() {
    var _self = this;

    dawaAutocomplete.dawaAutocomplete(document.getElementById("dawa-autocomplete-input"), {
      select: function select(selected) {
        _self.address = selected.data.vejnavn;
        _self.houseNumber = selected.data.husnr;
        _self.floor = selected.data.etage;
        _self.door = selected.data.dør;
        _self.city = selected.data.postnrnavn;
        _self.zip = selected.data.postnr;
        _self.addressInput = selected.tekst;
      }
    });
    this.$nextTick(function () {
      window.addEventListener("resize", this.reorderDiv());
    });
  },
  computed: {
    swiper: function swiper() {
      return this.$refs.awesomeSwiper.swiper;
    },
    addressComputed: function addressComputed() {
      var address = this.address ? this.address + " " : "";
      var houseNumber = this.houseNumber ? this.houseNumber : "";
      var floor = this.floor ? ", " + this.floor + ". " : "";
      var door = this.door ? this.door : "";
      return address + houseNumber + floor + door;
    },
    cityComputed: function cityComputed() {
      return this.zip + " " + this.city;
    },
    delAddressComputed: function delAddressComputed() {
      var address = this.delAddress ? this.delAddress + " " : "";
      var houseNumber = this.delHouseNumber ? this.delHouseNumber : "";
      var floor = this.delFloor ? ", " + this.delFloor + ". " : "";
      var door = this.delDoor ? this.delDoor : "";
      return address + houseNumber + floor + door;
    },
    delCityComputed: function delCityComputed() {
      return this.delZip + " " + this.delCity;
    },
    products: function products() {
      return this.$store.state.products;
    },
    shippingMethods: function shippingMethods() {
      return this.$store.state.shippingMethods;
    },
    taxTotal: function taxTotal() {
      return this.$store.state.basket.basketTotal * 0.02;
    },
    basketTotal: function basketTotal() {
      return this.$store.state.basket.basketTotal;
    },
    shippingPrice: function shippingPrice() {
      return this.$store.state.basket.shippingPrice;
    },
    chosenShippingMethod: function chosenShippingMethod() {
      var _this = this;

      return this.shippingMethods.find(function (x) {
        return x.id === _this.shipping;
      });
    },
    cartSummary: function cartSummary() {
      var cartSummary = [];
      $.each(this.products, function (index, product) {
        cartSummary.push(product.name);
      });
      return cartSummary;
    }
  },
  watch: {
    shipping: {
      handler: function handler(shipping, oldShipping) {
        var price = this.shippingMethods.find(function (x) {
          return x.id === shipping;
        }).price;
        var oldPrice = this.shippingMethods.find(function (x) {
          return x.id === oldShipping;
        }).price;
        this.calculateShipping(price, oldPrice);
      },
      deep: true
    }
  },
  methods: {
    fetchData: function fetchData(event) {
      event.preventDefault();

      var _self = this;

      var apiURL = "https://dawa.aws.dk/adresser/autocomplete";
      axios.get(apiURL, {
        params: {
          q: _self.addressInput
        }
      }).then(function (response) {
        _self.addresses = response.data;
      }).catch(function (error) {
        console.log(error.message);
      });
    },
    deleteItem: function deleteItem(productId) {
      console.log(productId);
      this.$store.dispatch("removeProduct", productId);
    },
    calculateShipping: function calculateShipping(price, oldPrice) {
      if (oldPrice !== undefined) {
        this.$store.dispatch("calculateShipping", -oldPrice);
      }

      this.$store.dispatch("calculateShipping", price);
    },
    setCompanyShipping: function setCompanyShipping() {
      if (this.company) {
        this.shipping = "dhl";
      }
    },
    scrollToBottom: function scrollToBottom() {
      if (!this.$v.$invalid) {
        $("html,body").animate({
          scrollTop: document.body.scrollHeight
        }, "slow");
      }
    },
    reorderDiv: function reorderDiv() {
      if ($(window).width() < 960) {
        $("#step-3").insertBefore("#step-2");
      }
    },
    scrollIndicator: function scrollIndicator() {
      window.onscroll = function () {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = winScroll / height * 100;
        $(".js-progress-bar").width(scrolled + "%");
      };
    },
    goToPayment: function goToPayment(event) {
      event.preventDefault();

      if (!this.$v.$invalid) {
        location.href = this.$refs.link.attributes.href.nodeValue;
      } else if (this.$v.name.$invalid || this.$v.address.$invalid || this.$v.email.$invalid || this.$v.phone.$invalid) {
        $('html, body').animate({
          scrollTop: $('#step-1').offset().top
        }, "slow");
      } else if (this.$v.consent.$invalid) {
        $('html, body').animate({
          scrollTop: document.body.scrollHeight
        }, "slow");
      }
    }
  }
});
$(document).ready(function () {
  $("select").formSelect();
});

function myFunction() {
  var txt;
  if (confirm("Invalid Voucher Code Entered By You ! Please Enter Again !")) {
    txt = "";
  } else {
    txt = "";
  }
  document.getElementById("demo").innerHTML = txt;
}