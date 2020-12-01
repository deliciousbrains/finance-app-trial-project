<template>
    <transition name="modal">
        <div class="modal-mask" @click="$emit('input', false)">
          <div class="modal-wrapper">
            <div class="modal-container max-w-screen-sm bg-white rounded-md mx-auto my-0 text-gray-900">

              <div class="font-bold text-xl p-4 border-b">
                <slot name="header"></slot>
              </div>

              <div class="modal-body">
                <slot name="body"></slot>
              </div>

              <div class="modal-footer">
                <slot name="footer">
                  default footer
                  <button class="modal-default-button" @click="$emit('input', false)">
                    Cancel
                  </button>
                </slot>
              </div>
            </div>
          </div>
        </div>
      </transition>
</template>

<script>
export default {
    props: ['open'],
    methods: {
        close: function () {
            this.$emit('input', false)
        }
    }
}
</script>

<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
}


.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    float: right;
}

/*
* The following styles are auto-applied to elements with
* transition="modal" when their visibility is toggled
* by Vue.js.
*
* You can easily play with the modal transition by editing
* these styles.
*/

.modal-enter {
    opacity: 0;
}

.modal-leave-active {
    opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

</style>