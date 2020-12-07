(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/dashboard/transaction.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/dashboard/transaction.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
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
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "transaction",
  props: {
    transaction: {
      required: true,
      type: Object
    }
  },
  data: function data() {
    return {
      editing: false
    };
  },
  methods: {
    deleteTransaction: function deleteTransaction() {
      var _this = this;

      if (confirm('Are you sure you want to delete this?') === false) {
        return;
      }

      axios["delete"]('/transaction/' + this.transaction.id).then(function (response) {
        _this.$emit('remove', _this.transaction.id);
      });
    },
    onTransactionSaved: function onTransactionSaved() {
      this.editing = false;
      this.$emit('update');
    }
  },
  computed: {
    formattedDate: function formattedDate() {
      var date = new Date(this.transaction.occurred_at.replace(' ', 'T'));
      return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      }) + ' at ' + date.toLocaleTimeString();
    },
    formattedAmount: function formattedAmount() {
      return Math.abs(this.transaction.amount).toFixed(0);
    },
    fraction: function fraction() {
      // I am sad to do this, but don't wanna waste time here :[
      return this.transaction.amount.toString().split('.')[1];
    },
    amountClass: function amountClass() {
      return this.transaction.amount > 0 ? 'text-green-500' : 'text-gray-500';
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/dashboard/transaction.vue?vue&type=template&id=2e6f9128&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/dashboard/transaction.vue?vue&type=template&id=2e6f9128& ***!
  \************************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c(
      "div",
      { staticClass: "mb-4 shadow-md bg-white rounded-md group" },
      [
        _c("div", { staticClass: "flex items-center mb-2 px-4 py-2" }, [
          _c("div", { staticClass: "flex-grow" }, [
            _c("div", { staticClass: "font-bold" }, [
              _vm._v(
                "\n                    " +
                  _vm._s(_vm.transaction.label) +
                  "\n                "
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "text-xs text-gray-500" }, [
              _vm._v(
                "\n                    " +
                  _vm._s(_vm.formattedDate) +
                  "\n                "
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "xl:flex-col mr-10" }, [
            _c(
              "a",
              {
                staticClass:
                  "pr-3 underline text-white uppercase md:text-sm group-hover:text-blue-700 font-bold",
                attrs: { href: "#" },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.editing = true
                  }
                }
              },
              [_vm._v("Edit")]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                staticClass:
                  "pr-2 underline text-white uppercase md:text-sm group-hover:text-red-700 font-bold",
                attrs: { href: "#" },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    return _vm.deleteTransaction($event)
                  }
                }
              },
              [_vm._v("Delete")]
            )
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "text-lg font-bold", class: _vm.amountClass },
            [
              _vm._v(
                "\n                " +
                  _vm._s(_vm.transaction.amount > 0 ? "+ " : "- ") +
                  "\n                $" +
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
        _vm.editing ? _c("hr") : _vm._e(),
        _vm._v(" "),
        _vm.editing
          ? _c("edit-entry", {
              attrs: { transaction: _vm.transaction },
              on: {
                cancel: function($event) {
                  _vm.editing = false
                },
                edited: _vm.onTransactionSaved
              }
            })
          : _vm._e()
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/dashboard/transaction.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/dashboard/transaction.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _transaction_vue_vue_type_template_id_2e6f9128___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./transaction.vue?vue&type=template&id=2e6f9128& */ "./resources/js/components/dashboard/transaction.vue?vue&type=template&id=2e6f9128&");
/* harmony import */ var _transaction_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./transaction.vue?vue&type=script&lang=js& */ "./resources/js/components/dashboard/transaction.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _transaction_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _transaction_vue_vue_type_template_id_2e6f9128___WEBPACK_IMPORTED_MODULE_0__["render"],
  _transaction_vue_vue_type_template_id_2e6f9128___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/dashboard/transaction.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/dashboard/transaction.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/dashboard/transaction.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./transaction.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/dashboard/transaction.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/dashboard/transaction.vue?vue&type=template&id=2e6f9128&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/dashboard/transaction.vue?vue&type=template&id=2e6f9128& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_vue_vue_type_template_id_2e6f9128___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./transaction.vue?vue&type=template&id=2e6f9128& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/dashboard/transaction.vue?vue&type=template&id=2e6f9128&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_vue_vue_type_template_id_2e6f9128___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_transaction_vue_vue_type_template_id_2e6f9128___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);