<template>
  <Head title="photos" />
  <master>
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto"></div>
        <div class="col-auto">
          <div class="page-utilities">
            <div
              class="
                row
                g-2
                justify-content-start justify-content-md-end
                align-items-center
              "
            >
              <div class="col-auto">
                <select
                  class="form-select w-auto"
                  v-model="category"
                  @change="CategoryFilter"
                >
                  <option value="all">All</option>
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                  >
                    {{ category.name.toUpperCase() }}
                  </option>
                </select>
              </div>
              <div class="col-auto">
                <a
                  class="btn app-btn-primary"
                  href="javascript:void(0);"
                  @click="addImage"
                  ><svg
                    width="1em"
                    height="1em"
                    viewBox="0 0 16 16"
                    class="bi bi-upload me-2"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"
                    />
                    <path
                      fill-rule="evenodd"
                      d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"
                    /></svg
                  >Upload Image</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-4">
        <p v-if="photos.data.length == 0" class="text-center">
          No Photo Available
        </p>
        <photo
          v-for="photo in photos.data"
          :key="photo.id"
          :photo="photo"
          v-else
        />
      </div>
      <nav class="app-pagination mt-5" v-if="photos.last_page > 1">
        <ul class="pagination justify-content-center">
          <li
            v-for="(link, index) in photos.links"
            :key="index"
            :class="['page-item', link.active ? 'active' : '']"
          >
            <Link
              class="page-link"
              :href="link.url"
              :disabled="link.url == null ? true : false"
              v-html="link.label"
            ></Link>
          </li>
        </ul>
      </nav>
    </div>
    <div
      class="modal fade"
      id="staticBackdrop"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
      ref="modelElm"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"
                  >Name</label
                >
                <input
                  type="email"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="Enter Photo Name"
                  v-model="form.name"
                />
                <span class="fw-bold text-danger" v-if="form.errors.name">
                  {{ form.errors.name[0] }}
                </span>
              </div>
              <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select
                  id="category"
                  class="form-select"
                  aria-label="Default select example"
                  v-model="form.category_id"
                >
                  <option :value="null">--Select Category--</option>
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                  >
                    {{ category.name.toUpperCase() }}
                  </option>
                </select>
                <span
                  class="fw-bold text-danger"
                  v-if="form.errors.category_id"
                >
                  {{ form.errors.category_id[0] }}
                </span>
              </div>
              <div class="row" v-if="!isEdit">
                <div class="col-3">
                  <label for="image" class="btn btn-sm app-btn-primary">
                    <i class="fas fa-images"></i>
                  </label>
                  <input
                    type="file"
                    id="image"
                    class="d-none"
                    accept="image/*"
                    @change="filePreview"
                  />
                </div>
                <div
                  class="col-9"
                  v-if="image != null || form.errors.file_name"
                >
                  <span
                    class="fw-bold text-danger"
                    v-if="form.errors.file_name"
                  >
                    {{ form.errors.file_name[0] }}
                  </span>
                  <img
                    v-if="image != null"
                    :src="image"
                    class="img-fluid"
                    height="200"
                    width="200"
                    id="image-priview"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn app-btn-primary"
              @click="
                isEdit
                  ? form.put($route('photos.update', { id: editId }), {
                      onSuccess: () => photoEdited(),
                      preserveScroll: true,
                    })
                  : form.post($route('photos.store'), {
                      onSuccess: () => photoUploaded(),
                    })
              "
            >
              Upload
            </button>
          </div>
        </div>
      </div>
    </div>
  </master>
</template>

<script>
import Master from "../../layouts/Master";
import { Link, Head, useForm } from "@inertiajs/inertia-vue3";
import Photo from "../../components/Photo";
import { reactive, ref } from "@vue/reactivity";
import { Inertia } from "@inertiajs/inertia";
import { onMounted, onUnmounted, provide, inject } from "@vue/runtime-core";
import { Modal } from "bootstrap";
import { Notify } from "notiflix";

export default {
  components: { Master, Head, Photo, Link },
  props: ["categories", "photos"],
  setup(props) {
    const modelElm = ref(null);
    const categories = props.categories;
    const category = ref("all");
    const image = ref(null);
    const isEdit = ref(false);
    const editId = ref(null);

    const form = useForm({
      name: "",
      category_id: null,
      file_name: null,
    });

    const addImage = () => {
      isEdit.value = false;
      const modal = new Modal(modelElm.value).show();
      modelElm.value.addEventListener("hide.bs.modal", () => form.reset());
    };
    const edit = (id) => {
      isEdit.value = true;
      const photo = props.photos.data.filter((elm) => elm.id == id);
      form.name = photo[0].name;
      form.category_id = photo[0].category_id;
      editId.value = id;
      const modal = new Modal(modelElm.value);

      modal.show();
      modelElm.value.addEventListener("hide.bs.modal", () => form.reset());
    };

    const photoEdited = () => {
      const model = Modal.getInstance(modelElm.value).hide();
      form.reset();
      Notify.success("Photo is Edited successfully!");
    };

    provide("edit", edit);

    const CategoryFilter = (e) => {
      Inertia.reload(
        route("photos.index"),
        { category_id: e.target.value },
        {
          preserveScroll: false,
          only: ["photos"],
        }
      );
    };

    const filePreview = (e) => {
      const file = e.target.files[0];
      const reader = new FileReader();
      reader.onload = () => (image.value = reader.result);
      reader.readAsDataURL(file);
      form.file_name = file;
    };

    const photoUploaded = () => {
      const model = Modal.getInstance(modelElm.value).hide();
      form.reset();
      Notify.success("Photo is uploaded successfully!");
    };

    const hideModalEvent = (e) => {
      console.log("hello");
    };

    onMounted(() => {
      // console.log(modelElm.rawValue)
    });

    return {
      modelElm,
      category,
      CategoryFilter,
      form,
      filePreview,
      image,
      photoUploaded,
      addImage,
      isEdit,
      editId,
      photoEdited,
    };
  },
};
</script>

<style></style>
