<template>
    <div
        class="d-flex my-3 p-3 align-items-center justify-content-left bg-white rounded"
    >
        <div class="px-2">
            <input type="checkbox" disabled />
        </div>
        <div class="pl-2 pr-4"><BAvatar /></div>
        <div class="row flex-grow-1">
            <div class="col-5">
                <span class="d-block">{{ employee.full_name }}</span>
                <small class="text-muted">{{ employee.role }}</small>
            </div>
            <div class="col-4">
                <span class="d-block">
                    {{`${employee.salary} ${employee.salary_currency}`}}
                </span>
                <small class="text-muted">{{ employee.staff_type }}</small>
            </div>
            <div class="col-3">
                <span class="d-block">{{ employee.status }}</span>
                <small class="text-muted">{{ employee.joined }}</small>
            </div>
        </div>
        <div class="d-flex">
            <div class="border-right">
                <button @click="updatedEmployee = true" class="btn text-muted">
                    <BIconPencilSquare />
                </button>
            </div>
            <div>
                <button @click="handelDeleteEmployee(employee.id)" class="btn text-danger">
                    <BIconTrash />
                </button>
            </div>
        </div>
         <EmployeeUpdateModal v-model="updatedEmployee" :employee="employee" />
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import {createEmployee, updateEmployee, deleteEmployee} from "@ui/http/employee.api";
import EmployeeUpdateModal from "@ui/components/employee/EmployeeUpdateModal";
import { BAvatar, BIconTrash, BIconPencilSquare } from "bootstrap-vue";


export default {
    name: "Employee",
    components: {
        BAvatar,
        BIconTrash,
        BIconPencilSquare,
        EmployeeUpdateModal
    },
    props: {
        employee: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            updatedEmployee: false
        }

    },
    methods: {
        ...mapActions("Employee", ["deleteEmployee"]),
        async handelDeleteEmployee(id){
            if(! confirm("Do you really want to delete employee")) return;
            try {
                const {status, statusText} = await deleteEmployee(id);
                if(status !== 200) throw new Error(statusText);
                this.deleteEmployee(id);
                window.alert("Employee Deleted.");
            } catch (error) {
                window.alert(error.message);
            }
        }
    }
};
</script>
