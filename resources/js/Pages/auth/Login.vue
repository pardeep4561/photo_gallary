<template>
  <Head title="Sign In" />
  <div class="app app-login p-0" @submit.prevent="form.post($route('login'))">
    <auth name="Log in">
      <div class="auth-form-container text-start">
        <form class="auth-form login-form">
          <div class="email mb-3">
            <label class="sr-only" for="signin-email">Email</label>
            <input
              id="signin-email"
              name="signin-email"
              type="text"
              class="form-control signin-email"
              placeholder="Email address"
              v-model="form.email"
            />
            <span class="fw-bold text-danger" v-if="form.errors.email">
              {{ form.errors.email[0] }}
            </span>
          </div>
          <div class="password mb-3">
            <label class="sr-only" for="signin-password">Password</label>
            <input
              id="signin-password"
              name="signin-password"
              :type="isHide ? 'password' : 'text'"
              class="form-control signin-password"
              placeholder="Password"
              v-model="form.password"
            />
            <span class="fw-bold text-danger" v-if="form.errors.password">
              {{ form.errors.password[0] }}
            </span>
            <div class="extra mt-3 row justify-content-between">
              <div class="col-6">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="form.remember"
                    id="RememberPassword"
                  />
                  <label class="form-check-label" for="RememberPassword">
                    Remember me
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="forgot-password text-end">
                  <a href="javascript:void(0);" @click="toggleHide()">
                    {{ isHide ? "Show Password" : "Hide Password" }}
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <button
              type="submit"
              class="btn app-btn-primary w-100 theme-btn mx-auto"
            >
              Log In
            </button>
          </div>
        </form>

        <div class="auth-option text-center pt-5">
          No Account? Sign up
          <Link class="text-link" :href="$route('register')">here</Link>.
        </div>
      </div>
    </auth>
  </div>
</template>

<script>
import { Link, Head, useForm } from "@inertiajs/inertia-vue3";
import Auth from "../../layouts/Auth";
import { useShowHide } from "../../composition/auth";

import { onMounted, reactive, toRefs } from "@vue/runtime-core";

export default {
  components: { Auth, Link, Head },
  props: ["test"],
  setup(props) {
    const { isHide, toggleHide } = useShowHide();

    const form = useForm({
      email: "",
      password: "",
      remember: false,
    });

    return {
      isHide,
      form,
      toggleHide,
    };
  },
};
</script>

<style></style>
