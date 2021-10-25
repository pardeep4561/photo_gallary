<template>
  <Head title="Sign Up" />
  <div class="app app-signup p-0">
    <auth name="Log in">
      <div class="auth-form-container text-start mx-auto">
        <form
          class="auth-form auth-signup-form"
          @submit.prevent="form.post($route('register'))"
        >
          <div class="email mb-3">
            <label class="sr-only" for="signup-email">Your Name</label>
            <input
              id="signup-name"
              name="signup-name"
              type="text"
              class="form-control signup-name"
              placeholder="Full name"
              v-model="form.name"
            />
            <span class="fw-bold text-danger" v-if="form.errors.name">
              {{ form.errors.name[0] }}
            </span>
          </div>
          <div class="email mb-3">
            <label class="sr-only" for="signup-email">Your Email</label>
            <input
              id="signup-email"
              name="signup-email"
              type="text"
              class="form-control signup-email"
              placeholder="Email"
              v-model="form.email"
            />
            <span class="fw-bold text-danger" v-if="form.errors.email">
              {{ form.errors.email[0] }}
            </span>
          </div>
          <div class="password mb-3">
            <label class="sr-only" for="signup-password">Password</label>
            <input
              id="signup-password"
              name="signup-password"
              :type="isHide ? 'password' : 'text'"
              class="form-control signup-password"
              placeholder="Create a password"
              v-model="form.password"
            />
            <span class="fw-bold text-danger" v-if="form.errors.password">
              {{ form.errors.password[0] }}
            </span>
          </div>
          <div class="extra mb-3">
            <div class="extra my-3 row justify-content-between">
              <div class="col-6"></div>
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
              Sign Up
            </button>
          </div>
        </form>

        <div class="auth-option text-center pt-5">
          Already have an account?
          <Link class="text-link" :href="$route('login')">Log in</Link>
        </div>
      </div>
    </auth>
  </div>
</template>

<script>
import Auth from "../../layouts/Auth";
import { Link, Head, useForm } from "@inertiajs/inertia-vue3";
import { useShowHide } from "../../composition/auth";

export default {
  components: { Auth, Link, Head },
  setup() {
    const { isHide, toggleHide } = useShowHide();

    const form = useForm({
      email: null,
      password: null,
      name: null,
    });

    return {
      isHide,
      toggleHide,
      form,
    };
  },
};
</script>

<style></style>
