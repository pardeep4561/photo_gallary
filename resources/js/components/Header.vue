<template>
  <header class="app-header fixed-top">
    <div class="app-header-inner">
      <div class="container-fluid py-2">
        <div class="app-header-content">
          <div class="row justify-content-end align-items-center">
            <div class="app-utilities col-auto">
              <div class="app-utility-item app-user-dropdown dropdown">
                <a
                  class="dropdown-toggle"
                  id="user-dropdown-toggle"
                  data-bs-toggle="dropdown"
                  href="#"
                  role="button"
                  aria-expanded="false"
                  ><img :src="`${$asset}images/user.png`" alt="user profile"
                /></a>
                <ul
                  class="dropdown-menu"
                  aria-labelledby="user-dropdown-toggle"
                >
                  <li>
                    <Link class="dropdown-item" :href="$route('logout')" method="post" as="button" >Log Out</Link>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="app-sidepanel" class="app-sidepanel">
      <div id="sidepanel-drop" class="sidepanel-drop"></div>
      <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none"
          >&times;</a
        >
        <div class="app-branding">
          <Link class="app-logo" :href="$route('photos.index')">
            <img
              class="logo-icon me-2"
              :src="`${$asset}images/app-logo.svg`"
              alt="logo"
            /><span class="logo-text">PORTAL</span>
          </Link>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: { Link },
};
</script>

<style></style>
