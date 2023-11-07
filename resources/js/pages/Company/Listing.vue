<template>
    <Master>
        <swal-toaster></swal-toaster>
        <div class="card">
            <!--begin::Card body-->
            <div class="card-header">
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <a :href="route('companies.create')" class="btn btn-primary">
                            <span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
													<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
												</svg>
                            </span>
                            Add Company</a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">Sr#</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Email</th>
                        <th class="min-w-125px">Website</th>
                        <th class="min-w-125px">Logo</th>
                        <th class="text-end min-w-100px">Actions</th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody v-if="companies.data.length>0" class="text-gray-600 fw-bold">
                    <tr v-for="(company,index) in companies.data" :key="company.id" >
                        <td>{{ (companies.current_page - 1) * companies.per_page + index + 1 }}</td>
                        <td>{{ company.name }}</td>
                        <td>{{ company.email }}</td>
                        <td>
                            <a v-if="typeof company.website === 'string'" :href="company.website">
                                <i  class="fa fa-eye"></i>
                            </a>

                        </td>
                        <td>
                            <img v-if="company.logo!='null'" style="width: 100px;height:100px;" :src="getImageUrl(company.logo)">
                        </td>
                        <td class="text-end">
                            <a :href="route('companies.edit',[company.id])" class="menu-link px-3"><i class="fa fa-edit"></i> </a>
                            <form ref="deleteForm" style="display: none" :action="'/companies/' + company.id" method="post">
                                <input type="hidden" name="_method" value="Delete">
                                <input type="submit" class="mt-2 btn btn-primary" value="Submit">
                            </form>
                            <a style="cursor: pointer" @click.prevent="deleteCompany(company.id)" class="menu-link px-3" data-kt-users-table-filter="delete_row"><i class="fa fa-trash"></i> </a>

                        </td>
                    </tr>
                    </tbody>
                    <tbody v-else class="text-gray-600 fw-bold">
                    <tr>
                        <td colspan="5">No data available</td>
                    </tr>
                    </tbody>
                    <!--end::Table body-->
                </table>
                <div class="mt-4">
                    <Bootstrap4Pagination align="right" :data="companies" @pagination-change-page="list" />
                </div>
            </div>
        </div>
    </Master>
</template>

<script>
import { defineComponent,ref} from "vue";
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import {AssetMixin} from "../../mixins/AssetMixin";
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import Master from "../Layouts/Master";
import SwalToaster from "../Layouts/SwalToaster";
export default defineComponent({
    name: "Listing",
    mixins:[AssetMixin],
    props:{
        companies:Object
    },
    data(){
        return {
            baseurl:assetUrl
        }
    },
    components: {SwalToaster, Master,Bootstrap4Pagination},

    methods:{
        getImageUrl(fileName) {
            return this.baseurl+`storage/logos/${fileName}`;
        },
        deleteCompany(companyId){
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'danger',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(route('companies.destroy', companyId));
                }
            });
        },
        list(page=1){
            this.$inertia.get(`/companies?page=${page}`, [], {
                onError: (errors) => {
                },
                onSuccess: (data) => {

                },
            });
        }
    }
});
</script>

