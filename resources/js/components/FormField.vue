<template>
    <default-field :field="field">
        <template slot="field">
            <input :id="field.name" type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
                maxlength="10"
                @blur="checkNationalCode"
            />

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data: function () {
      return {
        hasError: false,
        value: ''
      }
    },

    computed: {
      inputClass: function () {
        let classList = 'w-full form-control form-input form-input-bordered';

        if(! this.value) {
          return classList;
        }

        if (this.hasError) {
          return`${classList} border-danger`;
        }

        return `${classList} border-success`;
      }
    },


    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
          this.value = this.field.value || ''
        },

        checkID() {
            var id = this.value.trim();
            if (isNaN(parseInt(id))) {
                this.hasError = true;
            }
            if (id.length !== 10) {
                this.hasError = true;
            }
            var type = id.substr(0, 1);
            if (type !== '2' && type !== '1') {
                this.hasError = true;
            }
            var sum = 0;
            for (var i = 0; i < 10; i++) {
                if (i % 2 === 0) {
                    var ZFOdd = String('00' + String(Number(id.substr(i, 1)) * 2)).slice(-2);
                    sum += Number(ZFOdd.substr(0, 1)) + Number(ZFOdd.substr(1, 1));
                } else {
                    sum += Number(id.substr(i, 1));
                }
            }

            var valid = (sum % 10 !== 0) ? -1 : type;
            if (valid < 1) {
                this.hasError = true;
                return;
            }
            this.hasError = false;
        },


        checkNationalCode() {
          var id = this.value.trim();
            if (!/^\d{10}$/.test(id)
                || input=='0000000000'
                || input=='1111111111'
                || input=='2222222222'
                || input=='3333333333'
                || input=='4444444444'
                || input=='5555555555'
                || input=='6666666666'
                || input=='7777777777'
                || input=='8888888888'
                || input=='9999999999') {
                this.hasError = true;
                return;
              }

            var check = parseInt(input[9]);
            var sum = 0;
            var i;
            for (i = 0; i < 9; ++i) {
                sum += parseInt(input[i]) * (10 - i);
            }
            sum %= 11;
            this.hasError = (sum < 2 && check == sum) || (sum >= 2 && check + sum == 11);
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
          formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
          this.value = value
        }
    }
}
</script>
