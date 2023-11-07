<template>
    <Master>
        <div class="card">
            <!--begin::Card body-->
            <div class="card-header">
                <h4 class="fw-bolder text-dark mb-9">Add Employee</h4>
            </div>
            <div class="card-body pt-0">
                <form @submit.prevent="submitForm">
                    <div class="form-group">
                        <label  class="fs-5 fw-bold mb-2 required" for="first_name">First Name:</label>
                        <input class="form-control" v-model="form.first_name" type="text" id="first_name" name="first_name" />
                        <div class="text-danger">{{ errors.first_name ? errors.first_name[0] : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label  class="fs-5 fw-bold mb-2 required" for="last_name">Last Name:</label>
                        <input class="form-control" v-model="form.last_name" type="text" id="last_name" name="last_name" />
                        <div class="text-danger">{{ errors.last_name ? errors.last_name[0] : '' }}</div>
                    </div>
                    <div class="form-group">
                        <label  class="fs-5 fw-bold mb-2 required" for="company_id">Company:</label>
                        <select class="form-select" id="company_id" name="company_id" v-model="form.company_id">
                            <option value="">---Select Company-----</option>
                            <option v-if="companies.length>0" v-for="company in companies" :value="company.id">{{company.name}}</option>
                        </select>
                        <div class="text-danger">{{ errors.company_id ? errors.company_id[0] : '' }}</div>

                    </div>
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2" for="email">Email:</label>
                        <input class="form-control" v-model="form.email" type="email" id="email" name="email" />
                    </div>

                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2" for="phone">Phone:</label>
                        <input class="form-control" v-model="form.phone"  type="text" id="phone" name="phone" />
                    </div>
                    <button type="submit" class="mt-2 btn btn-primary">Submit</button>
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
    name: "Add",
    mixins:[AssetMixin,DisplayMixin],
    components: {Master},
    props: {
        companies:Object
    },
    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                email: '',
                company_id: null,
                phone: '',
            },
            errors: {},
        };
    },
    methods: {
        submitForm() {
            this.errors = {};
            let formData = new FormData();
            formData.append('first_name', this.form.first_name);
            formData.append('last_name', this.form.last_name);
            formData.append('email', this.form.email);
            formData.append('company_id', this.form.company_id);
            formData.append('phone', this.form.phone);
            this.$inertia.post(route('employees.store'), formData, {
                onError: (errors) => {
                    this.errors = errors;
                },
                onSuccess: () => {
                    this.$inertia.visit(route('employees.index'));
                },
            });
        }
    },
});
</script>
