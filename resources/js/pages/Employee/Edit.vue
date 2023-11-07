<template>
    <Master>
        <div class="card">
            <!--begin::Card body-->
            <div class="card-header">
                <h4 class="fw-bolder text-dark mb-9">Update Employee</h4>
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
                            <option value="">---Select Company---</option>
                            <option v-if="companies.length>0" v-for="company in companies" :value="company.id">{{company.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2" for="email">Email:</label>
                        <input class="form-control" v-model="form.email" type="email" id="email" name="email" />
                    </div>

                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2" for="phone">Phone:</label>
                        <input class="form-control" v-model="form.phone"  type="text" id="phone" name="phone" />
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
        'employee':Object,
        'companies':Object
    },
    components: {Master},
    data() {
        return {
            form: {
                id:this.employee.id,
                first_name: this.employee.first_name,
                last_name: this.employee.last_name,
                email: this.employee.email,
                company_id: this.employee.company_id,
                phone: this.employee.phone,
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
            formData.append('_method','PUT');
            this.$inertia.post(route('employees.update',[this.form.id]), formData, {
                onError: (errors) => {
                    this.errors = errors;
                },
                onSuccess: () => {
                },
            });
        }
    },
});
</script>
