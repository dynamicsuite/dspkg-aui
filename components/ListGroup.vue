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
        <aui-list-item v-for="(item, index) in data" :key="index" :callback="item.callback" :subtext="item.subtext">{{item.content}}</aui-list-item>
    </ul>
</template>

<script>
    export default {
        props: {
            data: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style lang="sass" scoped>
    .aui.list-group
        margin: 1rem 0
        padding: 0
        border: 1px solid #ced4da
        border-radius: .25rem
        background: white



</style>