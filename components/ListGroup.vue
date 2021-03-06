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
    <ul class="aui list-group">
        <li v-for="(row, key) in list" :key="'list-group-row-' + key" @click="$emit('click', row.value)">
            <span v-if="row.icon" class="leading-icon"><i :class="row.icon"></i></span>
            <div class="text">
                <div class="title">{{row.title}}</div>
                <div v-if="row.subtext" class="subtext" v-html="row.subtext" />
            </div>
            <span class="trailing-icon"></span>
        </li>
    </ul>
</template>

<script>
export default {
    props: {

        /**
         * The list of groups to render. Each child of the array must be an object and each object must contain a
         * "title" of type "String", and "value" of any type. The "value" will be emitted on click of the group. You
         * may also include a "subtext" of type "String" which will be subtext displayed on the row below the title. If
         * an "icon" of type "String" is present, the icon will be appended before the text values. The "icon" value
         * must be a valid Font Awesome icon class.
         */
        list: {
            type: Array,
            required: true,
            validator: value => {
                for (const row of value) {
                    if (typeof row.title !== 'string') {
                        return false;
                    }
                    if (typeof row.subtext !== 'undefined' && typeof row.subtext !== 'string') {
                        return false;
                    }
                    if (typeof row.icon !== 'undefined' && typeof row.icon !== 'string') {
                        return false;
                    }
                }
                return true;
            }
        }
    }

}
</script>

<style lang="sass">

/* Import the core DS colors */
@import "../../../client/css/colors"

/* List group container */
.aui.list-group
    padding: 0
    border: 1px solid #ced4da
    border-radius: 0.25rem
    background: white

    /* Individual list groups */
    li
        padding: 1rem 3rem 1rem 1rem
        list-style: none
        display: flex
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%23a2aeb9' d='M6.0848 3.9152l-3.3125 3.3125q-0.0848 0.0848-0.2009 0.0848t-0.2009-0.0848l-0.7411-0.7411q-0.0848-0.0848-0.0848-0.2009t0.0848-0.2009l2.3705-2.3705-2.3705-2.3705q-0.0848-0.0848-0.0848-0.2009t0.0848-0.2009l0.7411-0.7411q0.0848-0.0848 0.2009-0.0848t0.2009 0.0848l3.3125 3.3125q0.0848 0.0848 0.0848 0.2009t-0.0848 0.2009z'/%3e%3c/svg%3e")
        background-repeat: no-repeat
        background-position: right 0.5rem center
        background-size: 1.25rem

        /* Leading icon if present */
        .leading-icon
            font-size: 2rem
            color: lighten(#777, 30%)
            width: 2.5rem
            display: flex
            justify-content: center
            align-items: center

            /* Icon centering */
            i
                display: flex
                justify-content: center
                align-items: center

            /* Padding when icon present */
            & + .text
                margin-left: 1rem

        /* Vertical align text */
        .text
            display: flex
            flex-direction: column
            justify-content: center

        /* Entry title */
        .title
            font-weight: bold
            color: lighten(black, 10%)

        /* Entry subtext*/
        .subtext
            margin-top: 0.25rem
            font-size: 0.9rem
            color: #777

        /* Hover effects for the group*/
        &:hover
            cursor: pointer
            user-select: none
            background: rgba(0, 0, 0, 0.1) url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%238595a3' d='M6.0848 3.9152l-3.3125 3.3125q-0.0848 0.0848-0.2009 0.0848t-0.2009-0.0848l-0.7411-0.7411q-0.0848-0.0848-0.0848-0.2009t0.0848-0.2009l2.3705-2.3705-2.3705-2.3705q-0.0848-0.0848-0.0848-0.2009t0.0848-0.2009l0.7411-0.7411q0.0848-0.0848 0.2009-0.0848t0.2009 0.0848l3.3125 3.3125q0.0848 0.0848 0.0848 0.2009t-0.0848 0.2009z'/%3e%3c/svg%3e") no-repeat right 0.5rem center
            background-size: 1.25rem

        /* Group spacing style */
        &:not(:last-child)
            border-bottom: 1px solid #ced4da

</style>