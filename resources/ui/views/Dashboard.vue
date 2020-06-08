<template>
    <div id="dashboard">
        <div class="d-flex align-items-center">
            <div class="mr-auto"><h1>Employees</h1></div>
            <div class="ml-auto">
                <button @click="showCreateEmployee = true" class="btn btn-success rounded-pill">
                    Add Employee
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 d-none d-md-block">
                <div id="side-bar" class="bg-white rounded-lg my-3 py-4 px-3">
                    <div class="mb-5">
                        <button class="btn btn-lg btn-block text-left">
                            <h4 class="text-success font-weight-bold">All Employees</h4>
                        </button>
                    </div>
                    <div class="px-3 my-5">
                        <p class="text-muted">DEPARTMENTS</p>
                        <button v-for="department in departments" :key="department.id" class="btn btn-lg btn-outline-secondary btn-block text-left">
                            <div class="d-flex align-items-center">
                                <div class="pr-3"><BAvatar text="DT" variant="info" /></div>
                                <div class="">{{department.name}}</div>
                            </div>
                        </button>
                    </div>
                    <div class="px-3">
                        <p class="text-muted">STATUS</p>
                        <button class="btn btn-lg btn-outline-secondary btn-block text-left">
                            <BAvatar text="FT" variant="success" />
                            Full Time
                        </button>
                        <button class="btn btn-lg btn-outline-secondary btn-block text-left">
                            <BAvatar text="PT" variant="info" />
                            Part Time
                        </button>
                        <button class="btn btn-lg btn-outline-secondary btn-block text-left">
                            <BAvatar text="CT" variant="primary" />
                            Contract
                        </button>

                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <Employee v-for="employee in employees" :employee="employee" :key="employee.id" />
            </div>
        </div>
        <EmployeeCreateModal v-model="showCreateEmployee" />
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import { BAvatar } from "bootstrap-vue";

import Employee from "@ui/components/employee/Employee";
import EmployeeCreateModal from "@ui/components/employee/EmployeeCreateModal";


export default {
    name: "Dashboard",
    components: {
        BAvatar,
        Employee,
        EmployeeCreateModal
    },
    computed: {
        ...mapState("Employee", ["employees"]),
        ...mapState("Department", ["departments"])
    },
    data() {
        return {
            showCreateEmployee: false,
        }
    },
    methods: {
        ...mapActions("Employee", ["loadEmployees"]),
        ...mapActions("Department", ["loadDepartments", "deleteDepartment"]),
    },

    created() {
        this.loadEmployees();
        this.loadDepartments();
    },
    mounted() {
        document.title = `${document.title} | Dashboard`;
    }
};
</script>

<style lang="scss" scoped>
#dashboard {
    margin: 0 !important;
    padding: 2rem 1.5rem;
}
</style>
