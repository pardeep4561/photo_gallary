<template>
    <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
        <div class="app-card app-card-doc shadow-sm h-100">
            <div class="app-card-thumb-holder p-3">
                <div class="app-card-thumb">
                    <img
                        class="thumb-image"
                        :src="`${$asset}images/photos/${photo.file_name}`"
                        alt=""
                    />
                </div>
                <span class="badge bg-success text-capitalize">{{
                    photo.category.name
                }}</span>
                <a class="app-card-link-mask" href="#file-link"></a>
            </div>
            <div class="app-card-body p-3 has-card-actions">
                <h4 class="app-doc-title truncate mb-0">
                    <a href="#file-link">{{
                        photo.name.length > 20 ? `${photo.name}...` : photo.name
                    }}</a>
                </h4>
                <div class="app-doc-meta">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <span class="text-muted">By:</span>
                            {{ photo.user.name }}
                        </li>
                        <li>
                            <span class="text-muted">Added:</span>
                            {{ photo.time }}
                        </li>
                    </ul>
                </div>

                <div class="app-card-actions">
                    <div class="dropdown">
                        <div
                            class="dropdown-toggle no-toggle-arrow"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <svg
                                width="1em"
                                height="1em"
                                viewBox="0 0 16 16"
                                class="bi bi-three-dots-vertical"
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"
                                />
                            </svg>
                        </div>
                        <action  :id="photo.id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { provide } from '@vue/runtime-core';
import Action from "./Action";
export default {
    components: { Action },
    props: ["photo"],
    setup(props){

        provide('photo',props.photo);
        return {

        }
    }
};
</script>

<style></style>
