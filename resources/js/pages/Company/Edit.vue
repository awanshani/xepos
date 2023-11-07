<template>
    <Master>
        <div class="card">
            <!--begin::Card body-->
            <div class="card-header">
                <h4 class="fw-bolder text-dark mb-9">Update Company</h4>
            </div>
            <div class="card-body pt-0">
                <form @submit.prevent="submitForm">
                    <div class="form-group">
                        <label  class="fs-5 fw-bold mb-2 required" for="name">Name:</label>
                        <input class="form-control" v-model="form.name" type="text" id="name" name="name" />
                        <div class="text-danger">{{ errors.name ? errors.name[0] : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2" for="email">Email:</label>
                        <input class="form-control" v-model="form.email" type="email" id="email" name="email" />
                        <div class="text-danger">{{ errors.email ? errors.email[0] : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2" for="logo">Logo:</label>
                        <input class="form-control" id="logo" type="file" @change="onFileChange" />
                        <div class="text-danger">{{ errors.logo?errors.logo[0]:'' }}</div>
                    </div>
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2" for="website">Website:</label>
                        <input class="form-control" v-model="form.website" type="text" id="website" name="website" />
                        <div class="text-danger">{{ errors.website ? errors.website[0] : '' }}</div>
                    </div>
                    <button type="submit" class="mt-2 btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </Master>
</template>

<script>
import { defineComponent } from "vue";
import {AssetMixin} from "../../mixins/AssetMixin";
import Master from "../Layouts/Master";
import DisplayMixin from "../../mixins/DisplayMixin.js";

export default defineComponent({
    name: "Edit",
    mixins:[AssetMixin,DisplayMixin],
    props:{
        'company':Object
    },
    components: {Master},
    data() {
        return {
            form: {
                id:this.company.id,
                name:this.company.name,
                logo: null,
                website: this.company.website,
                email: this.company.email,
            },
            errors: {},
        };
    },
    methods: {
        submitForm() {
            this.errors = {};
            let formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('logo', this.form.logo);
            formData.append('email', this.form.email);
            formData.append('website', this.form.website);
            formData.append('_method','PUT');
            this.$inertia.post(route('companies.update',[this.form.id]), formData, {
                onError: (errors) => {
                    this.errors = errors;
                },
                onSuccess: () => {
                    // this.$inertia.visit(route('companies.index'));
                },
            });
        },
        onFileChange(event) {
            this.form.logo = event.target.files[0];
        },
    },
});
</script>
