<!--
Aui Package
Copyright (C) 2020 Dynamic Suite Team

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation version 3.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software Foundation,
Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301  USA
-->

<template>
    <aui-form-control v-bind="properties">
        <input
            ref="input"
            :value="value"
            :type="type"
            :list="unique_id"
            :autocomplete="autocomplete"
            :placeholder="placeholder"
            :tabindex="tabindex"
            :disabled="disabled"
            :step="step"
            @focus="$emit('focus', $event.target)"
            @blur="$emit('blur', $event.target)"
            @change="$emit('change', $event.target)"
            @input="handleInput($event.target.value)"
            @keydown="$emit('keydown', $event)"
        />
        <datalist v-if="!!options.length && array_options" :id="unique_id">
            <option v-for="(value, key) in options" :key="'option-' + key" :value="value" />
        </datalist>
        <datalist v-if="!array_options && !!Object.keys(options).length" :id="unique_id">
            <option v-for="(value, key) in options" :key="'option-' + key" :value="key">{{value}}</option>
        </datalist>
    </aui-form-control>
</template>

<script>
export default {
    props: {

        /**
         * Input label.
         *
         * This is an alias for the slot content when using plaintext. Slot should be used if custom HTML is
         * required.
         */
        label: {
            type: String | null,
            default: null
        },

        /**
         * Content to display in the leading input cap.
         *
         * Free-form HTML.
         */
        leading_cap: {
            type: String | null,
            default: null
        },

        /**
         * Content to display in the trailing input cap.
         *
         * Free-form HTML.
         */
        trailing_cap: {
            type: String | null,
            default: null
        },

        /**
         * The model binding value of the input.
         */
        value: {
            type: String | Number | Boolean | null,
            default: null
        },

        /**
         * Input type.
         */
        type: {
            type: String,
            default: 'text',
            validator(value) {
                return ['color',
                    'date',
                    'datetime-local',
                    'email',
                    'file',
                    'number',
                    'password',
                    'range',
                    'search',
                    'tel',
                    'text',
                    'time',
                    'url',
                    'week'
                ].indexOf(value) !== -1;
            }
        },

        /**
         * Input autocomplete value.
         */
        autocomplete: {
            type: String | null,
            default: null
        },

        /**
         * Input placeholder text.
         */
        placeholder: {
            type: String | null,
            default: null
        },

        /**
         * If the input is disabled and non-interactive.
         */
        disabled: {
            type: Boolean,
            default: false
        },

        /**
         * Options if a datalist is used.
         *
         * This must be an array of string/numeric values that should be used to generate the datalist and bind to the
         * model.
         */
        options: {
            type: Array | Object,
            default: () => []
        },

        /**
         * Input tab index.
         */
        tabindex: {
            type: String | Number | null,
            default: null
        },

        /**
         * Input step for numeric inputs.
         */
        step: {
            type: String | Number | null,
            default: null
        },

        /**
         * The maximum number of whole digits for numeric inputs.
         */
        max_whole_digits: {
            type: String | Number | null,
            default: null
        },

        /**
         * The maximum number of decimal digits for numeric inputs.
         */
        max_decimal_digits: {
            type: String | Number | null,
            default: null
        },

        /**
         * Success subtext to display under the input.
         *
         * Subtext values override each other in the following order, only one may be present at a time:
         *
         * success > failure > subtext
         */
        success: {
            type: String | null,
            default: null
        },

        /**
         * Failure subtext to display under the input.
         *
         * Subtext values override each other in the following order, only one may be present at a time:
         *
         * success > failure > subtext
         */
        failure: {
            type: String | null,
            default: null
        },

        /**
         * Subtext to display under the input.
         *
         * Subtext values override each other in the following order, only one may be present at a time:
         *
         * success > failure > subtext
         */
        subtext: {
            type: String | null,
            default: null
        },

        /**
         * If no icon should trail the input on feedback, for use in short length inputs.
         */
        no_feedback_icon: {
            type: Boolean,
            default: false
        }

    },
    computed: {

        /**
         * Properties to pass down to the form control component.
         *
         * @returns {
         *     {parent: string},
         *     {label: string},
         *     {leading_cap: string},
         *     {trailing_cap: string},
         *     {success: string},
         *     {failure: string},
         *     {subtext: string},
         *     {no_feedback_icon: boolean}
         * }
         */
        properties() {
            return {
                parent: 'input',
                label: this.$slots.default ? this.$slots.default : this.label,
                leading_cap: this.leading_cap,
                trailing_cap: this.trailing_cap,
                success: this.success,
                failure: this.failure,
                subtext: this.subtext,
                no_feedback_icon: this.no_feedback_icon
            };
        },

        /**
         * A unique ID for the datalist to bind to the input.
         *
         * @returns {string}
         */
        unique_id() {
            return `aui-input-${this._uid}`;
        },

        /**
         * If the options for the datalist are an array.
         *
         * @returns {boolean}
         */
        array_options() {
            return Array.isArray(this.options);
        }

    },
    methods: {

        /**
         * Handle input events to mask telephones.
         *
         * @param {string|number} value - The input value.
         * @returns {undefined}
         */
        handleInput(value) {
            if (this.type === 'tel') {
                let x = value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
                this.$refs.input.value = value;
            } else if (this.type === 'number' && value !== '') {
                value = value.replace('e', '');
                if (this.max_decimal_digits === 0) {
                    value = value.replace('.', '');
                }
                const has_decimal = value.includes('.');
                const exploded = value.split('.');
                let new_value = '';
                if (this.max_whole_digits > 0 && exploded[0].length > this.max_whole_digits) {
                    new_value = exploded[0].slice(0, -1);
                } else {
                    new_value = exploded[0];
                }
                if (this.max_decimal_digits > 0 && has_decimal && exploded[1].length > this.max_decimal_digits) {
                    new_value += '.' + exploded[1].slice(0, -1);
                } else if (this.max_decimal_digits !== 0 && typeof exploded[1] !== 'undefined') {
                    new_value += '.' + exploded[1]
                }
                if (new_value) {
                    value = new_value;
                }
                this.$refs.input.value = value;
            }
            this.$emit('input', value);
        }

    }
}
</script>