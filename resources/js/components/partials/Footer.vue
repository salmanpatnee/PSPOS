<template>
    <footer class="main-footer" v-if="authenticated">
    </footer>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters([
            'authenticated', 'user'
        ])
    }
}
</script>