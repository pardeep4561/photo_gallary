<template>
    <transition name="fade">
        <div v-if="isLoaded">
            <div class="row g-0 app-auth-wrapper">
                <div
                    class="
                        col-12 col-md-7 col-lg-6
                        auth-main-col
                        text-center
                        p-5
                    "
                >
                    <div class="d-flex flex-column align-content-end">
                        <div class="app-auth-body mx-auto">
                            <div class="app-auth-branding mb-4">
                                <Link class="app-logo" :href="$route('home')"
                                    ><img
                                        class="logo-icon me-2"
                                        :src="`${$asset}images/app-logo.svg`"
                                        alt="logo"
                                /></Link>
                            </div>
                            <h2 class="auth-heading text-center mb-5">
                                {{ name }} to Portal
                            </h2>
                            <slot />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
                    <div class="auth-background-holder"></div>
                    <div class="auth-background-mask"></div>
                    <div class="auth-background-overlay p-3 p-lg-5">
                        <div class="d-flex flex-column align-content-end h-100">
                            <div class="h-100"></div>
                            <div class="overlay-content p-3 p-lg-4 rounded">
                                <h5 class="mb-3 overlay-title">
                                    Explore Portal Admin Template
                                </h5>
                                <div>
                                    Portal is a free Bootstrap 5 admin dashboard
                                    template. You can download and view the
                                    template license
                                    <a
                                        href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/"
                                        >here</a
                                    >.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted, reactive, toRefs } from "@vue/runtime-core";

export default {
    components: {
        Link,
    },
    props: ["name"],
    
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
