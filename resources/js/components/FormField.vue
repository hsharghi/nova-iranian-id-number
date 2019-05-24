<template>
    <default-field :field="field">
        <template slot="field">
            <input :id="field.name" type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
                maxlength="10"
                @blur="checkIdNumber"
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

        checkIdNumber() {


          var id = this.value.trim();
            if (!/^\d{10}$/.test(id)
                || id=='0000000000'
                || id=='1111111111'
                || id=='2222222222'
                || id=='3333333333'
                || id=='4444444444'
                || id=='5555555555'
                || id=='6666666666'
                || id=='7777777777'
                || id=='8888888888'
                || id=='9999999999') {
                this.hasError = true;
                return;
              }
              console.log('checking...');

            var check = parseInt(id[9]);
            var sum = 0;
            var i;
            for (i = 0; i < 9; ++i) {
                sum += parseInt(id[i]) * (10 - i);
            }
            sum %= 11;
            this.hasError = !((sum < 2 && check == sum) || (sum >= 2 && check + sum == 11));
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
