<template>
    <div>
        <BModal
            v-model="value"
            id="employeeCreateModal"
            ref="employeeCreateModal"
            title="Create New Employee"
            ok-title="Continue"
            ok-variant="outline-success"
            cancel-variant="outline-secondary"
            @show="resetModal"
            @hidden="resetModal"
            @ok.prevent="handleCreateEmployee"
            @cancel.prevent="toggleShow(false)"
            @close.prevent="toggleShow(false)"
            no-close-on-backdrop
            no-close-on-esc
            centered
        >
            <div class="d-block text-center">
                <form @submit.prevent="handleCreateEmployee" class="text-left">
                    <div class="form-group">
                        <label for="fullName">Employee Name</label>
                        <input
                            type="text"
                            v-model="employeeUpdate.full_name"
                            class="form-control"
                            id="fullName"
                        />
                    </div>
                    <div class="form-group">
                        <label for="employmentDate">Employee Date</label>
                        <input
                            type="date"
                            v-model="employeeUpdate.employment_date"
                            class="form-control"
                            id="employmentDate"
                        />
                    </div>
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text"
                                    id="addon-salary"
                                >
                                    <select
                                        v-model="employeeUpdate.salary_currency"
                                        id=""
                                    >
                                        <option
                                            v-for="currency in currencies"
                                            :value="currency"
                                            :key="currency"
                                            >{{ currency }}</option
                                        >
                                    </select>
                                </span>
                            </div>
                            <input
                                type="number"
                                v-model="employeeUpdate.salary"
                                class="form-control"
                                placeholder="Salary Amount"
                                aria-label="Salary"
                                aria-describedby="addon-salary"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jobRole">Position</label>
                        <input
                            type="text"
                            v-model="employeeUpdate.role"
                            class="form-control"
                            placeholder="Job Position"
                            id="jobRole"
                        />
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select
                            v-model="employeeUpdate.department_id"
                            id="department"
                            class="custom-select"
                        >
                            <option value="" selected disabled
                                >Select Department</option
                            >
                            <option
                                v-for="department in departments"
                                :value="department.id"
                                :key="department.id"
                                >{{ department.name }}</option
                            >
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jobType">Job Type</label>
                        <select
                            v-model="employeeUpdate.staff_type"
                            id="jobType"
                            class="custom-select"
                        >
                            <option value="" selected disabled
                                >Select Job Type</option
                            >
                            <option
                                v-for="jobType in staffTypes"
                                :value="jobType"
                                :key="jobType"
                                >{{ jobType }}</option
                            >
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jobStatus">Current Status</label>
                        <select
                            v-model="employeeUpdate.status"
                            id="jobStatus"
                            class="custom-select"
                        >
                            <option value="" selected disabled
                                >Select current status</option
                            >
                            <option
                                v-for="status in statuses"
                                :value="status"
                                :key="status"
                                >{{ status }}</option
                            >
                        </select>
                    </div>
                </form>
            </div>
        </BModal>
    </div>
</template>

<script>
import { updateEmployee } from "@ui/http/employee.api";
import {
    staffTypes,
    staffStatuses,
    staffSalaryCurrencies
} from "@ui/config/sys.config";
import { mapActions, mapState } from "vuex";
import { BModal } from "bootstrap-vue";
export default {
    name: "EmployeeCreateModal",
    props: {
        value: {
            type: Boolean,
            default: false
        },
        employee: {
            type: Object,
            required: true
        }
    },
    components: {
        BModal
    },
    computed: {
        ...mapState("Department", ["departments"])
    },
    data() {
        return {
            currencies: staffSalaryCurrencies,
            staffTypes: staffTypes,
            statuses: staffStatuses,
            employeeUpdate: {}
        };
    },
    methods: {
        ...mapActions("Employee", ["updateEmployee"]),
        async handleCreateEmployee() {
            updateEmployee(this.employee.id, this.employeeUpdate)
                .then(({ status, data, statusText }) => {
                    if (status !== 200) throw new Error(data.message || statusText);
                    this.updateEmployee(data);
                    alert("Employee Updated");
                    this.toggleShow();
                })
                .catch(error => {
                    alert(error.message);
                });
        },
        resetModal() {
            this.employeeUpdate = {
                department_id: this.employee.department_id,
                employment_date: this.employee.employment_date,
                full_name: this.employee.full_name,
                role: this.employee.role,
                salary: this.employee.salary,
                salary_currency: this.employee.salary_currency,
                staff_type: this.employee.staff_type,
                status: this.employee.status
            };
        },
        toggleShow(value = false) {
            this.$emit("input", value);
        }
    },
    created() {
        this.resetModal();
    }
};
</script>
