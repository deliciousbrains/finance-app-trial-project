(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/dashboard/transaction-group.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/dashboard/transaction-group.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "transaction-group",
  props: {
    date: {
      required: true,
      type: String
    },
    data: {
      required: true,
      type: Array
    }
  },
  data: function data() {
    return {
      transactions: this.data
    };
  },
  watch: {
    data: function data() {
      this.transactions = this.data;
    }
  },
  methods: {
    removeTransaction: function removeTransaction(id) {
      var _this = this;

      this.transactions.forEach(function (transaction) {
        if (transaction.id === id) {
          _this.transactions.splice(_this.transactions.indexOf(transaction), 1);

          _this.$emit('remove');
        }
      });
    },
    updateTransaction: function updateTransaction() {
      this.$emit('update');
    }
  },
  computed: {
    total: function total() {
      var total = 0;
      this.transactions.forEach(function (transaction) {
        total += parseFloat(transaction.amount);
      });
      return total;
    },
    formattedAmount: function formattedAmount() {
      return Math.abs(this.total).toFixed(0);
    },
    fraction: function fraction() {
      // I am sad to do this, but don't wanna waste time here :[
      return this.total.toFixed(2).toString().split('.')[1];
    },
    amountClass: function amountClass() {
      return this.total > 0 ? 'text-green-500' : 'text-gray-500';
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/dashboard/transaction-group.vue?vue&type=template&id=0daee69a&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/dashboard/transaction-group.vue?vue&type=template&id=0daee69a& ***!
  \******************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.transactions.length
    ? _c(
        "div",
        { staticClass: "mb-8" },
        [
          _c("div", { staticClass: "flex items-center mb-4" }, [
            _c(
              "span",
              {
                staticClass:
                  "flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight"
              },
              [_vm._v(_vm._s(_vm.date))]
            ),
            _vm._v(" "),
            _c(
              "span",
              {
                staticClass: "text-lg text-gray-500 font-bold",
                class: _vm.amountClass
              },
              [
                _vm._v(
                  "\n            " +
                    _vm._s(this.total > 0 ? "+ " : "- ") +
                    "\n            $" +
                    _vm._s(_vm.formattedAmount) +
                    "."
                ),
                _c("span", { staticClass: "text-sm" }, [
                  _vm._v(_vm._s(_vm.fraction))
                ])
              ]
            )
          ]),
          _vm._v(" "),
          _vm._l(_vm.transactions, function(transaction) {
            return _c("transaction", {
              key: transaction.id,
              attrs: { transaction: transaction },
              on: {
                remove: _vm.removeTransaction,
                update: _vm.updateTransaction
              }
            })
          })
        ],
        2
      )
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/dashboard/transaction-group.vue":
/*!*****************************************************************!*\
  !*** ./resources/js/components/dashboard/transaction-group.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _transaction_group_vue_vue_type_template_id_0daee69a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./transaction-group.vue?vue&type=template&id=0daee69a& */ "./resources/js/components/dashboard/transaction-group.vue?vue&type=template&id=0daee69a&");
/* harmony import */ var _transaction_group_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./transaction-group.vue?vue&type=script&lang=js& */ "./resources/js/components/dashboard/transaction-group.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _transaction_group_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _transaction_group_vue_vue_type_template_id_0daee69a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _transaction_group_vue_vue_type_template_id_0daee69a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/dashboard/transaction-group.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/dashboard/transaction-group.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/dashboard/transaction-group.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_group_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./transaction-group.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/dashboard/transaction-group.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_group_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/dashboard/transaction-group.vue?vue&type=template&id=0daee69a&":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/dashboard/transaction-group.vue?vue&type=template&id=0daee69a& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_group_vue_vue_type_template_id_0daee69a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./transaction-group.vue?vue&type=template&id=0daee69a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/dashboard/transaction-group.vue?vue&type=template&id=0daee69a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_group_vue_vue_type_template_id_0daee69a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_group_vue_vue_type_template_id_0daee69a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);