<template>
 <transition name="fade">
    <div class="app" v-if="isLoaded">
        <Header />
        <div class="app-wrapper">
           <div class="app-content pt-3 p-md-3 p-lg-4">
             <slot />
           </div>
           <Footer />
        </div>
    </div>
 </transition>
</template>

<script>
import Header from "../components/Header";
import Footer from '../components/Footer';
import { onMounted, reactive, toRefs } from "@vue/runtime-core";

export default {
    components: {
        Header,
        Footer
    },
     setup() {

        const state = reactive({
            isLoaded: false,
        });

        onMounted(() => state.isLoaded = true);

        return {
            ...toRefs(state)
        };
    },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
