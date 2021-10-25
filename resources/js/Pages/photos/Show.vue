<template>
    <Head title="photos" />
    <master>
        <div class="container-xl">
            <Link class="btn app-btn-primary" :href="$route('photos.index')">Back</Link>
            <div class="row">
                <div class="col-5">
                    <img
                        class="img-fluid mt-5"
                        :src="`${$asset}images/photos/${photo.file_name}`"
                    />
                </div>
                <div class="col-6">
                    <div
                        class="
                            app-card app-card-account
                            shadow-sm
                            d-flex
                            flex-column
                            align-items-start
                        "
                    >
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg
                                            width="1em"
                                            height="1em"
                                            viewBox="0 0 16 16"
                                            class="bi bi-sliders"
                                            fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">Details</h4>
                                </div>
                            </div>
                          </div>
                        <div class="app-card-body px-4 w-100">
                            <div class="item border-bottom py-3">
                                <div
                                    class="
                                        row
                                        justify-content-between
                                        align-items-center
                                    "
                                >
                                    <div class="col-auto">
                                        <div class="item-label">
                                            <strong>Name </strong>
                                        </div>
                                        <div class="item-data">{{ photo.name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div
                                    class="
                                        row
                                        justify-content-between
                                        align-items-center
                                    "
                                >
                                    <div class="col-auto">
                                        <div class="item-label">
                                            <strong>Photo Category</strong>
                                        </div>
                                        <div class="item-data">
                                            {{ photo.category.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div
                                    class="
                                        row
                                        justify-content-between
                                        align-items-center
                                    "
                                >
                                    <div class="col-auto">
                                        <div class="item-label">
                                            <strong>Photo Added By</strong>
                                        </div>
                                        <div class="item-data">
                                            {{ photo.user.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </master>
</template>

<script>
import Master from "../../layouts/Master";
import { Link, Head, useForm } from "@inertiajs/inertia-vue3";

export default {
    components: { Master, Head,Link },
    props: ["photo"],
    setup() {
        return {};
    },
};
</script>

<style></style>
